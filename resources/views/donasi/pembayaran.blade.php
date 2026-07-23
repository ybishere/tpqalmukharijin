@extends('layouts.app')

@section('title', 'Pembayaran Donasi — TPQ Al-Mukharijin')

@section('content')
<section class="max-w-lg mx-auto px-4 py-16">

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-green-600 via-yellow-400 to-green-600"></div>

        <div class="p-8 text-center">

            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-1">Selesaikan Pembayaran</h2>
            <p class="text-sm text-gray-500 mb-6">Klik tombol di bawah untuk membuka halaman pembayaran</p>

            {{-- Detail donasi --}}
            <div class="bg-gray-50 rounded-2xl p-5 text-left space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Donatur</span>
                    <span class="font-semibold text-gray-800">{{ $donasi->nama_donatur }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Program</span>
                    <span class="font-semibold text-gray-800">{{ $program->nama_program }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Jumlah</span>
                    <span class="font-bold text-green-600 text-lg">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">No. Referensi</span>
                    <span class="font-mono text-xs text-gray-600">{{ $donasi->midtrans_id }}</span>
                </div>
            </div>

            <button id="pay-button"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3.5 rounded-xl text-sm transition shadow-sm mb-3">
                💳 Bayar Sekarang
            </button>

        @if(app()->environment('local'))
            <div class="mb-3 p-3 bg-amber-50 border border-amber-200 rounded-xl">
                <p class="text-xs text-amber-600 font-semibold mb-2">🧪 Mode Testing</p>
                <a href="{{ route('donasi.simulasi', $donasi->id_donasi) }}"
                class="block w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-xl text-sm transition text-center">
                    ✅ Simulasi Pembayaran Berhasil
                </a>
            </div>
        @endif

            <a href="{{ route('beranda') }}" class="text-xs text-gray-400 hover:text-gray-600">
                Batalkan & kembali ke beranda
            </a>

        </div>
    </div>

</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = '{{ route('donasi.status', $donasi->id_donasi) }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route('donasi.status', $donasi->id_donasi) }}';
            },
            onError: function(result) {
                window.location.href = '{{ route('donasi.status', $donasi->id_donasi) }}';
            },
            onClose: function() {
                alert('Pembayaran dibatalkan. Silakan coba lagi.');
            }
        });
    });
</script>
@endsection