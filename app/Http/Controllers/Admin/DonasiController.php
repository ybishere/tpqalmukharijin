<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::with('program')->latest();

        if ($request->filled('status')) {
            $query->where('status_bayar', $request->status);
        }
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('search')) {
            $query->where('nama_donatur', 'like', '%' . $request->search . '%');
        }

        $donasis   = $query->paginate(15)->withQueryString();
        $programs  = Program::orderBy('nama_program')->get();
        $totalMasuk = Donasi::where('status_bayar', 'sukses')->sum('jumlah');
        $totalPending = Donasi::where('status_bayar', 'menunggu')->count();

        return view('admin.donasi.index', compact('donasis', 'programs', 'totalMasuk', 'totalPending'));
    }

    public function create()
    {
        $programs = Program::where('status', 'aktif')->orderBy('nama_program')->get();
        return view('admin.donasi.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id'   => 'required|exists:programs,id_program',
            'nama_donatur' => 'nullable|string|max:100',
            'jumlah'       => 'required|numeric|min:1000',
            'metode'       => 'required|in:qris,manual',
            'status_bayar' => 'required|in:sukses,menunggu,gagal',
            'catatan'      => 'nullable|string',
        ], [
            'program_id.required' => 'Program wajib dipilih.',
            'program_id.exists'   => 'Program tidak ditemukan.',
            'jumlah.required'     => 'Jumlah donasi wajib diisi.',
            'jumlah.min'          => 'Minimal donasi Rp 1.000.',
        ]);

        $validated['nama_donatur'] = $validated['nama_donatur'] ?? 'Anonim';
        $validated['admin_id']     = Auth::guard('admin')->id();

        $donasi = Donasi::create($validated);

        // Update dana_terkumpul jika sukses
        if ($validated['status_bayar'] === 'sukses') {
            $donasi->program->increment('dana_terkumpul', $validated['jumlah']);
        }

        return redirect()->route('admin.donasi.index')
            ->with('success', 'Donasi berhasil dicatat.');
    }

    public function show(Donasi $donasi)
    {
        $donasi->load('program');
        return view('admin.donasi.show', compact('donasi'));
    }

    public function edit(Donasi $donasi)
    {
        $programs = Program::where('status', 'aktif')->orderBy('nama_program')->get();
        return view('admin.donasi.edit', compact('donasi', 'programs'));
    }

    public function update(Request $request, Donasi $donasi)
    {
        $validated = $request->validate([
            'program_id'   => 'required|exists:programs,id_program',
            'nama_donatur' => 'nullable|string|max:100',
            'jumlah'       => 'required|numeric|min:1000',
            'metode'       => 'required|in:qris,manual',
            'status_bayar' => 'required|in:sukses,menunggu,gagal',
            'catatan'      => 'nullable|string',
        ]);

        $statusLama  = $donasi->status_bayar;
        $jumlahLama  = $donasi->jumlah;
        $programLama = $donasi->program_id;

        $validated['nama_donatur'] = $validated['nama_donatur'] ?? 'Anonim';
        $donasi->update($validated);

        // Recalculate dana_terkumpul
        // Kurangi dulu kalau status lama sukses
        if ($statusLama === 'sukses') {
            $donasi->program->decrement('dana_terkumpul', $jumlahLama);
        }
        // Tambah kalau status baru sukses
        if ($validated['status_bayar'] === 'sukses') {
            $donasi->fresh()->program->increment('dana_terkumpul', $validated['jumlah']);
        }

        return redirect()->route('admin.donasi.index')
            ->with('success', 'Donasi berhasil diperbarui.');
    }

    public function destroy(Donasi $donasi)
    {
        if ($donasi->status_bayar === 'sukses') {
            $donasi->program->decrement('dana_terkumpul', $donasi->jumlah);
        }
        $donasi->delete();

        return redirect()->route('admin.donasi.index')
            ->with('success', 'Donasi berhasil dihapus.');
    }

    public function konfirmasi(Donasi $donasi)
    {
        if ($donasi->status_bayar !== 'sukses') {
            $donasi->update(['status_bayar' => 'sukses']);
            $donasi->program->increment('dana_terkumpul', $donasi->jumlah);
        }

        return redirect()->back()->with('success', 'Donasi berhasil dikonfirmasi.');
    }
}