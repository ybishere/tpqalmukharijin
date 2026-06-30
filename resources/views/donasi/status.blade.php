@extends('layouts.app')

@section('title', 'Status Donasi — TPQ Al-Mukharijin')

@section('content')
<section class="max-w-lg mx-auto px-4 py-16">

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-green-600 via-yellow-400 to-green-600"></div>

        <div class="p-8 text-center">

            {{-- Icon status --}}
            @if ($donasi->status_bayar === 'sukses')
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-1">Donasi Berhasil!</h2>
                <p class="text-sm text-gray-500 mb-6">Jazakallah khairan. Donasi Anda telah diterima.</p>
            @elseif ($donasi->status_bayar === 'menunggu')
                <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-1">Menunggu Konfirmasi</h2>
                <p class="text-sm text-gray-500 mb-6">Donasi Anda sedang diverifikasi oleh admin. Mohon konfirmasi via WhatsApp.</p>
            @else
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-1">Donasi Gagal</h2>
                <p class="text-sm text-gray-500 mb-6">Terjadi kesalahan. Silakan coba lagi atau hubungi admin.</p>
            @endif

            {{-- Detail donasi --}}
            <div class="bg-gray-50 rounded-2xl p-5 text-left space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Donatur</span>
                    <span class="font-semibold text-gray-800">{{ $donasi->nama_donatur }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Program</span>
                    <span class="font-semibold text-gray-800 text-right max-w-[180px]">{{ $donasi->program->nama_program }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Jumlah</span>
                    <span class="font-bold text-green-600 text-base">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Metode</span>
                    <span class="font-semibold text-gray-800 uppercase">{{ $donasi->metode }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">No. Referensi</span>
                    <span class="font-mono text-xs text-gray-600">#{{ str_pad($donasi->id_donasi, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                @if ($donasi->catatan)
                <div class="pt-2 border-t border-gray-200">
                    <p class="text-xs text-gray-400 mb-0.5">Pesan / Doa</p>
                    <p class="text-sm text-gray-700 italic">"{{ $donasi->catatan }}"</p>
                </div>
                @endif
            </div>

            {{-- Instruksi jika menunggu --}}
            @if ($donasi->status_bayar === 'menunggu')
            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 text-left mb-6">
                <p class="text-xs font-semibold text-amber-700 mb-2">Langkah selanjutnya:</p>
                @if ($donasi->metode === 'qris')
                <ol class="space-y-1.5 text-xs text-amber-700 list-decimal list-inside">
                    <li>Lakukan pembayaran via QRIS ke rekening TPQ</li>
                    <li>Screenshot bukti pembayaran</li>
                    <li>Kirim bukti ke WhatsApp admin dengan menyebut No. Referensi <strong>#{{ str_pad($donasi->id_donasi, 6, '0', STR_PAD_LEFT) }}</strong></li>
                </ol>
                @else
                <ol class="space-y-1.5 text-xs text-amber-700 list-decimal list-inside">
                    <li>Transfer ke rekening TPQ Al-Mukharijin (segera hadir)</li>
                    <li>Screenshot bukti transfer</li>
                    <li>Kirim bukti ke WhatsApp admin dengan menyebut No. Referensi <strong>#{{ str_pad($donasi->id_donasi, 6, '0', STR_PAD_LEFT) }}</strong></li>
                </ol>
                @endif
            </div>

            <a href="https://wa.me/6281234567890?text=Assalamualaikum, saya ingin konfirmasi donasi.%0ANo. Referensi: %23{{ str_pad($donasi->id_donasi, 6, '0', STR_PAD_LEFT) }}%0ANama: {{ urlencode($donasi->nama_donatur) }}%0AJumlah: Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}"
                target="_blank"
                class="flex items-center justify-center gap-2 w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl text-sm transition mb-3">
                💬 Konfirmasi via WhatsApp
            </a>
            @endif

            <div class="flex gap-3">
                <a href="{{ route('program.detail', $donasi->program->id_program) }}"
                    class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 rounded-xl text-sm transition">
                    Lihat Program
                </a>
                <a href="{{ route('beranda') }}"
                    class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-xl text-sm transition">
                    Beranda
                </a>
            </div>

        </div>
    </div>

</section>
@endsection