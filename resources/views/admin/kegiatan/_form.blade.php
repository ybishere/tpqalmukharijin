@php $isEdit = isset($kegiatan); @endphp

<div class="space-y-5">

    {{-- Judul --}}
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Judul Kegiatan <span class="text-red-400">*</span></label>
        <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul ?? '') }}"
            placeholder="Masukkan judul kegiatan..."
            class="w-full border {{ $errors->has('judul') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        @error('judul') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Tanggal + Status --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tanggal <span class="text-red-400">*</span></label>
            <input type="date" name="tanggal"
                value="{{ old('tanggal', isset($kegiatan) ? \Carbon\Carbon::parse($kegiatan->tanggal)->format('Y-m-d') : '') }}"
                class="w-full border {{ $errors->has('tanggal') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            @error('tanggal') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Status <span class="text-red-400">*</span></label>
            <select name="status"
                class="w-full border {{ $errors->has('status') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                @foreach(['akan_datang' => 'Akan Datang', 'berlangsung' => 'Berlangsung', 'selesai' => 'Selesai'] as $val => $label)
                <option value="{{ $val }}" {{ old('status', $kegiatan->status ?? '') == $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
                @endforeach
            </select>
            @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Thumbnail --}}
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Thumbnail</label>
        @if($isEdit && $kegiatan->thumbnail)
        <div class="mb-2">
            <img src="{{ Storage::url($kegiatan->thumbnail) }}" class="h-24 rounded-xl object-cover border border-stone-100">
            <p class="text-[11px] text-stone-400 mt-1">Upload baru untuk mengganti.</p>
        </div>
        @endif
        <input type="file" name="thumbnail" accept="image/*"
            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
        @error('thumbnail') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
        <textarea name="deskripsi" rows="5"
            placeholder="Tulis deskripsi kegiatan..."
            class="w-full border {{ $errors->has('deskripsi') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('deskripsi', $kegiatan->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Foto yang sudah ada (edit mode) --}}
    @if($isEdit && $kegiatan->photos->count())
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-2">Foto Saat Ini</label>
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
            @foreach($kegiatan->photos as $photo)
            <div class="relative group">
                <img src="{{ Storage::url($photo->foto) }}"
                    class="w-full aspect-square object-cover rounded-xl border border-stone-100">
                @if($photo->keterangan)
                <p class="text-[10px] text-stone-400 mt-1 truncate">{{ $photo->keterangan }}</p>
                @endif
                <label class="absolute top-1.5 right-1.5 w-6 h-6 rounded-lg bg-white/90 border border-red-200 flex items-center justify-center cursor-pointer group-hover:opacity-100 opacity-0 transition-opacity">
                    <input type="checkbox" name="hapus_foto[]" value="{{ $photo->id }}" class="sr-only peer">
                    <svg class="w-3 h-3 text-stone-300 peer-checked:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </label>
            </div>
            @endforeach
        </div>
        <p class="text-[11px] text-stone-400 mt-2">Hover foto lalu centang ✕ untuk menghapus.</p>
    </div>
    @endif

    {{-- Upload foto baru --}}
    <div x-data="{ files: [] }">
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">
            {{ $isEdit ? 'Tambah Foto Baru' : 'Upload Foto' }}
        </label>
        <input type="file" name="foto[]" accept="image/*" multiple
            @change="files = Array.from($event.target.files)"
            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
        <p class="text-[11px] text-stone-400 mt-1">Bisa pilih beberapa foto sekaligus.</p>

        {{-- Preview --}}
        <div x-show="files.length" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-3">
            <template x-for="(file, i) in files" :key="i">
                <div>
                    <div class="w-full aspect-square rounded-xl bg-stone-100 overflow-hidden border border-stone-200">
                        <img :src="URL.createObjectURL(file)" class="w-full h-full object-cover">
                    </div>
                    <input type="text" :name="`keterangan[${i}]`"
                        placeholder="Keterangan foto..."
                        class="mt-1 w-full border border-stone-200 rounded-lg px-2 py-1 text-[11px] text-stone-600 focus:outline-none focus:border-emerald-400 transition-all">
                </div>
            </template>
        </div>
    </div>

</div>


