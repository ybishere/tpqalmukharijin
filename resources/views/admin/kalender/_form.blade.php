@php $isEdit = isset($kalender); @endphp

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
    <div class="space-y-5">

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Judul Jadwal <span class="text-red-400">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $isEdit ? $kalender->judul : '') }}"
                placeholder="Contoh: Libur Hari Raya Idul Fitri..."
                class="w-full border {{ $errors->has('judul') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            @error('judul') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tanggal Mulai <span class="text-red-400">*</span></label>
                <input type="date" name="tanggal_mulai"
                    value="{{ old('tanggal_mulai', $isEdit ? \Carbon\Carbon::parse($kalender->tanggal_mulai)->format('Y-m-d') : '') }}"
                    class="w-full border {{ $errors->has('tanggal_mulai') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                @error('tanggal_mulai') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tanggal Selesai <span class="text-stone-300">(opsional)</span></label>
                <input type="date" name="tanggal_selesai"
                    value="{{ old('tanggal_selesai', $isEdit && $kalender->tanggal_selesai ? \Carbon\Carbon::parse($kalender->tanggal_selesai)->format('Y-m-d') : '') }}"
                    class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                @error('tanggal_selesai') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Jenis <span class="text-red-400">*</span></label>
                <select name="jenis"
                    class="w-full border {{ $errors->has('jenis') ? 'border-red-300' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @foreach(['libur' => 'Libur', 'ujian' => 'Ujian', 'wisuda' => 'Wisuda', 'kegiatan' => 'Kegiatan', 'pengumuman' => 'Pengumuman'] as $val => $label)
                    <option value="{{ $val }}" {{ old('jenis', $isEdit ? $kalender->jenis : '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('jenis') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Status</label>
                <div class="flex items-center gap-3 h-[42px]">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                            {{ old('is_active', $isEdit ? $kalender->is_active : true) ? 'checked' : '' }}>
                        <div class="w-10 h-5 bg-stone-200 peer-checked:bg-emerald-500 rounded-full transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                    </label>
                    <span class="text-xs text-stone-500">Tampil di publik</span>
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Keterangan</label>
            <textarea name="keterangan" rows="3"
                placeholder="Keterangan tambahan..."
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('keterangan', $isEdit ? $kalender->keterangan : '') }}</textarea>
        </div>

    </div>
</div>


