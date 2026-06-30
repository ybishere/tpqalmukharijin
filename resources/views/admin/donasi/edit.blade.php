@extends('admin.layouts.app')

@section('title', 'Edit Donasi')
@section('page_title', 'Edit Donasi')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span>
    <a href="{{ route('admin.donasi.index') }}" class="text-emerald-600 hover:underline">Donasi</a>
    <span>/</span> <span>Edit</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-emerald-600 via-yellow-500 to-emerald-600"></div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.donasi.update', $donasi) }}" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Program <span class="text-red-500">*</span></label>
                    <select name="program_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                        @foreach ($programs as $p)
                            <option value="{{ $p->id_program }}" {{ old('program_id', $donasi->program_id) == $p->id_program ? 'selected' : '' }}>
                                {{ $p->nama_program }}
                            </option>
                        @endforeach
                    </select>
                    @error('program_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Donatur</label>
                    <input type="text" name="nama_donatur" value="{{ old('nama_donatur', $donasi->nama_donatur) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Donasi (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" value="{{ old('jumlah', $donasi->jumlah) }}"
                        class="w-full border {{ $errors->has('jumlah') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('jumlah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Metode</label>
                        <select name="metode"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                            <option value="manual" {{ old('metode', $donasi->metode) == 'manual' ? 'selected' : '' }}>Manual (Transfer)</option>
                            <option value="qris"   {{ old('metode', $donasi->metode) == 'qris'   ? 'selected' : '' }}>QRIS</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Bayar</label>
                        <select name="status_bayar"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                            <option value="sukses"   {{ old('status_bayar', $donasi->status_bayar) == 'sukses'   ? 'selected' : '' }}>Sukses</option>
                            <option value="menunggu" {{ old('status_bayar', $donasi->status_bayar) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="gagal"    {{ old('status_bayar', $donasi->status_bayar) == 'gagal'    ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan</label>
                    <textarea name="catatan" rows="3"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('catatan', $donasi->catatan) }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.donasi.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection