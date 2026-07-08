<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Program;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Mail\DonasiMasuk;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DonasiPublikController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    public function form($program_id)
    {
        $program = Program::findOrFail($program_id);
        $persen  = $program->target_dana > 0
            ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
            : 0;
        return view('donasi.form', compact('program', 'persen'));
    }

    public function store(Request $request, $program_id)
    {
        $program = Program::findOrFail($program_id);

        $validated = $request->validate([
            'nama_donatur' => 'nullable|string|max:100',
            'jumlah'       => 'required|numeric|min:1000',
            'catatan'      => 'nullable|string|max:500',
        ], [
            'jumlah.required' => 'Jumlah donasi wajib diisi.',
            'jumlah.min'      => 'Minimal donasi Rp 1.000.',
        ]);

        $donasi = Donasi::create([
            'program_id'   => $program->id_program,
            'nama_donatur' => $validated['nama_donatur'] ?? 'Anonim',
            'jumlah'       => $validated['jumlah'],
            'metode'       => 'qris',
            'status_bayar' => 'menunggu',
            'catatan'      => $validated['catatan'] ?? null,
        ]);

        $orderId = 'TPQ-' . str_pad($donasi->id_donasi, 6, '0', STR_PAD_LEFT) . '-' . time();
        $donasi->update(['midtrans_id' => $orderId]);

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $validated['jumlah'],
            ],
            'customer_details' => [
                'first_name' => $validated['nama_donatur'] ?? 'Anonim',
                'email'      => 'donatur@tpq-almukharijin.id',
            ],
            'item_details' => [
                [
                    'id'       => 'PROGRAM-' . $program->id_program,
                    'price'    => (int) $validated['jumlah'],
                    'quantity' => 1,
                    'name'     => 'Donasi: ' . substr($program->nama_program, 0, 50),
                ]
            ],
            'callbacks' => [
                'finish' => route('donasi.status', $donasi->id_donasi),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('donasi.pembayaran', compact('donasi', 'program', 'snapToken'));
        } catch (\Exception $e) {
            $donasi->delete();
            return back()->withErrors(['jumlah' => 'Gagal membuat transaksi: ' . $e->getMessage()]);
        }
    }

    public function status($id)
    {
        $donasi = Donasi::with('program')->findOrFail($id);
        return view('donasi.status', compact('donasi'));
    }

    public function webhook(Request $request)
{
    $serverKey   = config('midtrans.server_key');
    $orderId     = $request->order_id;
    $statusCode  = $request->status_code;
    $grossAmount = $request->gross_amount;

    // Validasi signature
    $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

    if ($signatureKey !== $request->signature_key) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $donasi = Donasi::where('midtrans_id', $orderId)->first();

    if (!$donasi) {
        return response()->json(['message' => 'Donasi not found'], 404);
    }

    $transactionStatus = $request->transaction_status;
    $paymentType       = $request->payment_type;

    if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
        if ($donasi->status_bayar !== 'sukses') {
            $donasi->update([
                'status_bayar' => 'sukses',
                'metode'       => $paymentType === 'qris' ? 'qris' : 'manual',
            ]);
            $donasi->program->increment('dana_terkumpul', $donasi->jumlah);

            // Email notifikasi
            try {
                Mail::to(config('mail.admin_email', 'admin@tpq-almukharijin.id'))
                    ->send(new DonasiMasuk($donasi->fresh()->load('program')));
            } catch (\Exception $e) {
                Log::error('Gagal kirim email notifikasi: ' . $e->getMessage());
            }

            // WhatsApp notifikasi
            try {
                $freshDonasi = $donasi->fresh()->load('program');
                $pesan = "🌿 *Donasi Masuk — TPQ Al-Mukharijin*\n\n"
                    . "👤 *Donatur:* " . ($freshDonasi->nama_donatur ?? 'Anonim') . "\n"
                    . "📋 *Program:* " . ($freshDonasi->program->nama_program ?? '-') . "\n"
                    . "💰 *Jumlah:* Rp " . number_format($freshDonasi->jumlah, 0, ',', '.') . "\n"
                    . "💳 *Metode:* " . strtoupper($paymentType) . "\n"
                    . "🕐 *Waktu:* " . now()->translatedFormat('d F Y, H:i') . " WIB\n\n"
                    . "Jazakumullah khairan atas kepercayaannya. 🤲";

                \App\Services\WhatsAppService::send(
                    config('services.fonnte.admin_wa'),
                    $pesan
                );
            } catch (\Exception $e) {
                Log::error('Gagal kirim WA notifikasi: ' . $e->getMessage());
            }
        }
    } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
        $donasi->update(['status_bayar' => 'gagal']);
    } elseif ($transactionStatus === 'pending') {
        $donasi->update(['status_bayar' => 'menunggu']);
    }

    return response()->json(['message' => 'OK']);
}
}