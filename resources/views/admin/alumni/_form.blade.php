@php $isEdit = isset($alumni); @endphp

<div class="space-y-5">
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
        <input type="text" name="nama" value="{{ old('nama', $alumni->nama ?? '') }}"
            placeholder="Nama lengkap alumni..."
            class="w-full border {{ $errors->has('nama') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tahun Angkatan <span class="text-red-400">*</span></label>
        <input type="number" name="tahun_angkatan"
            value="{{ old('tahun_angkatan', $alumni->tahun_angkatan ?? date('Y')) }}"
            min="1990" max="{{ date('Y') + 1 }}"
            class="w-full border {{ $errors->has('tahun_angkatan') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        @error('tahun_angkatan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Keterangan</label>
        <textarea name="keterangan" rows="3"
            placeholder="Keterangan tambahan (opsional)..."
            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('keterangan', $alumni->keterangan ?? '') }}</textarea>
    </div>
</div>


