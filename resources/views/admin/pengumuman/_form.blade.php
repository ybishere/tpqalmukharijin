@php $isEdit = isset($pengumuman); @endphp

<div class="space-y-5">

    {{-- Judul --}}
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Judul Pengumuman <span class="text-red-400">*</span></label>
        <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul ?? '') }}"
            placeholder="Masukkan judul pengumuman..."
            class="w-full border {{ $errors->has('judul') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
        @error('judul') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Tanggal + Status --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tanggal Publish <span class="text-red-400">*</span></label>
            <input type="date" name="tanggal_publish"
                value="{{ old('tanggal_publish', isset($pengumuman) ? \Carbon\Carbon::parse($pengumuman->tanggal_publish)->format('Y-m-d') : today()->format('Y-m-d')) }}"
                class="w-full border {{ $errors->has('tanggal_publish') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            @error('tanggal_publish') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-stone-600 mb-1.5">Status</label>
            <div class="flex items-center gap-3 h-[42px]">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                        {{ old('is_active', $pengumuman->is_active ?? true) ? 'checked' : '' }}>
                    <div class="w-10 h-5 bg-stone-200 peer-checked:bg-emerald-500 rounded-full transition-colors after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
                <span class="text-xs text-stone-500">Aktif / tampil di publik</span>
            </div>
        </div>
    </div>

    {{-- Thumbnail --}}
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Thumbnail</label>
        @if($isEdit && $pengumuman->thumbnail)
        <div class="mb-2">
            <img src="{{ Storage::url($pengumuman->thumbnail) }}"
                class="h-24 rounded-xl object-cover border border-stone-100">
            <p class="text-[11px] text-stone-400 mt-1">Thumbnail saat ini. Upload baru untuk mengganti.</p>
        </div>
        @endif
        <input type="file" name="thumbnail" accept="image/*"
            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
        @error('thumbnail') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Isi --}}
    <div>
        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Isi Pengumuman <span class="text-red-400">*</span></label>
        <textarea name="isi" rows="8"
            placeholder="Tulis isi pengumuman di sini..."
            class="w-full border {{ $errors->has('isi') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('isi', $pengumuman->isi ?? '') }}</textarea>
        @error('isi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

</div>


