@extends('admin.layouts.app')

@section('title', 'Detail Donasi')
@section('page_title', 'Detail Donasi')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span>
    <a href="{{ route('admin.donasi.index') }}" class="text-emerald-600 hover:underline">Donasi</a>
    <span>/</span> <span>Detail</span>
@endsection

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-emerald-600 via-yellow-500 to-emerald-600"></div>
        <div class="p-6 space-y-4">

            <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Info Donasi</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                    {{ $donasi->status_bayar === 'sukses'   ? 'bg-emerald-100 text-emerald-700' :
                      ($donasi->status_bayar === 'menunggu' ? 'bg-amber-100 text-amber-700' :
                                                              'bg-red-100 text-red-600') }}">
                    {{ ucfirst($donasi->status_bayar) }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Donatur</p>
                    <p class="font-semibold text-gray-800">{{ $donasi->nama_donatur }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Jumlah</p>
                    <p class="font-bold text-emerald-600 text-lg">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Program</p>
                    <p class="font-semibold text-gray-800">{{ $donasi->program->nama_program ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Metode</p>
                    <p class="font-semibold text-gray-800 uppercase">{{ $donasi->metode }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Tanggal</p>
                    <p class="font-semibold text-gray-800">{{ $donasi->created_at->format('d F Y, H:i') }}</p>
                </div>
                @if ($donasi->midtrans_id)
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">ID Midtrans</p>
                    <p class="font-mono text-xs text-gray-600">{{ $donasi->midtrans_id }}</p>
                </div>
                @endif
            </div>

            @if ($donasi->catatan)
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-400 mb-1">Catatan</p>
                <p class="text-sm text-gray-700">{{ $donasi->catatan }}</p>
            </div>
            @endif

            <div class="flex gap-2 pt-2">
                @if ($donasi->status_bayar === 'menunggu')
                <form method="POST" action="{{ route('admin.donasi.konfirmasi', $donasi) }}"
                    onsubmit="return confirm('Konfirmasi donasi ini?')">
                    @csrf
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                        Konfirmasi
                    </button>
                </form>
                @endif
                <a href="{{ route('admin.donasi.edit', $donasi) }}"
                    class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                    Edit
                </a>
                <a href="{{ route('admin.donasi.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


