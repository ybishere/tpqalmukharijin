@php $isEdit = isset($prestasi); @endphp

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
    <div class="space-y-5">

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama Santri <span class="text-red-400">*</span></label>
            <select name="student_id"
                class="w-full border {{ $errors->has('student_id') ? 'border-red-300' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                <option value="">-- Pilih Santri --</option>
                @foreach($students as $s)
                <option value="{{ $s->id }}" {{ old('student_id', $isEdit ? $prestasi->student_id : '') == $s->id ? 'selected' : '' }}>
                    {{ $s->nama }} {{ $s->kelas_jilid ? '('.$s->kelas_jilid.')' : '' }}
                </option>
                @endforeach
            </select>
            @error('student_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Judul Prestasi <span class="text-red-400">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $isEdit ? $prestasi->judul : '') }}"
                placeholder="Contoh: Juara MTQ Tilawah Putra..."
                class="w-full border {{ $errors->has('judul') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            @error('judul') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tingkat <span class="text-red-400">*</span></label>
                <select name="tingkat"
                    class="w-full border {{ $errors->has('tingkat') ? 'border-red-300' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @foreach(['desa' => 'Desa', 'kecamatan' => 'Kecamatan', 'kabupaten' => 'Kabupaten', 'provinsi' => 'Provinsi', 'nasional' => 'Nasional'] as $val => $label)
                    <option value="{{ $val }}" {{ old('tingkat', $isEdit ? $prestasi->tingkat : '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('tingkat') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Juara <span class="text-red-400">*</span></label>
                <input type="text" name="juara" value="{{ old('juara', $isEdit ? $prestasi->juara : '') }}"
                    placeholder="Juara 1 / Harapan 1..."
                    class="w-full border {{ $errors->has('juara') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                @error('juara') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', $isEdit ? $prestasi->kategori : '') }}"
                    placeholder="MTQ, Tahfidz, Pidato..."
                    class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            </div>
            <div>
                <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tahun <span class="text-red-400">*</span></label>
                <input type="number" name="tahun" value="{{ old('tahun', $isEdit ? $prestasi->tahun : date('Y')) }}"
                    min="2000" max="{{ date('Y') }}"
                    class="w-full border {{ $errors->has('tahun') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                @error('tahun') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Keterangan</label>
            <textarea name="keterangan" rows="3"
                placeholder="Keterangan tambahan..."
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('keterangan', $isEdit ? $prestasi->keterangan : '') }}</textarea>
        </div>

    </div>
</div>


