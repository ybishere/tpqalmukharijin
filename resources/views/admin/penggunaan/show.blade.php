@extends('admin.layouts.app')

@section('title', 'Detail Penggunaan Dana')
@section('page_title', 'Detail Penggunaan Dana')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span>
    <a href="{{ route('admin.penggunaan.index') }}" class="text-emerald-600 hover:underline">Penggunaan Dana</a>
    <span>/</span> <span>Detail</span>
@endsection

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-emerald-600 via-yellow-500 to-emerald-600"></div>

        @if ($penggunaan->bukti_foto)
            <img src="{{ Storage::url($penggunaan->bukti_foto) }}" class="w-full h-52 object-cover">
        @endif

        <div class="p-6 space-y-4">
            <h3 class="font-bold text-gray-800">Detail Penggunaan Dana</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="col-span-2">
                    <p class="text-xs text-gray-400 mb-0.5">Uraian</p>
                    <p class="font-medium text-gray-800 leading-relaxed">{{ $penggunaan->uraian }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Program</p>
                    <p class="font-semibold text-gray-800">{{ $penggunaan->program->nama_program ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Jumlah</p>
                    <p class="font-bold text-purple-600 text-lg">Rp {{ number_format($penggunaan->jumlah, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Dicatat oleh</p>
                    <p class="font-semibold text-gray-800">{{ $penggunaan->admin->name ?? 'System' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Tanggal</p>
                    <p class="font-semibold text-gray-800">{{ $penggunaan->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <a href="{{ route('admin.penggunaan.edit', $penggunaan) }}"
                    class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.penggunaan.destroy', $penggunaan) }}"
                    onsubmit="return confirm('Hapus data ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                        Hapus
                    </button>
                </form>
                <a href="{{ route('admin.penggunaan.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection