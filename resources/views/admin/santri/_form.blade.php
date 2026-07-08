@php $isEdit = isset($santri); @endphp

<div class="space-y-5">

    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2">
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
            <input type="text" name="nama" value="{{ old('nama', $santri->nama ?? '') }}"
                placeholder="Nama lengkap santri..."
                class="w-full border {{ $errors->has('nama') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Jenis Kelamin <span class="text-red-400">*</span></label>
            <select name="jenis_kelamin"
                class="w-full border {{ $errors->has('jenis_kelamin') ? 'border-red-300' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir"
                value="{{ old('tanggal_lahir', isset($santri) && $santri->tanggal_lahir ? $santri->tanggal_lahir->format('Y-m-d') : '') }}"
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Kelas / Jilid</label>
            <input type="text" name="kelas_jilid" value="{{ old('kelas_jilid', $santri->kelas_jilid ?? '') }}"
                placeholder="Contoh: Jilid 3, Kelas A..."
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama Orang Tua</label>
            <input type="text" name="nama_orang_tua" value="{{ old('nama_orang_tua', $santri->nama_orang_tua ?? '') }}"
                placeholder="Nama ayah/ibu..."
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">No. HP Orang Tua</label>
            <input type="text" name="no_hp_orang_tua" value="{{ old('no_hp_orang_tua', $santri->no_hp_orang_tua ?? '') }}"
                placeholder="08xx-xxxx-xxxx..."
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        </div>

        <div class="col-span-2">
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Alamat</label>
            <textarea name="alamat" rows="3"
                placeholder="Alamat lengkap..."
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('alamat', $santri->alamat ?? '') }}</textarea>
        </div>

        <div class="col-span-2">
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Status</label>
            <div class="flex items-center gap-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                        {{ old('is_active', $santri->is_active ?? true) ? 'checked' : '' }}>
                    <div class="w-10 h-5 bg-stone-200 peer-checked:bg-emerald-500 rounded-full transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
                <span class="text-xs text-stone-500">Santri aktif</span>
            </div>
        </div>
    </div>

</div>