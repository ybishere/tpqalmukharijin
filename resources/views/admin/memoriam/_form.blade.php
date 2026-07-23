@php $isEdit = isset($memoriam); @endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kolom kiri --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Info dasar --}}
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
            <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Informasi Tokoh</h3>
            <div class="space-y-4">

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama Tokoh <span class="text-red-400">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $memoriam->nama ?? '') }}"
                        placeholder="Nama lengkap tokoh..."
                        class="w-full border {{ $errors->has('nama') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tahun Lahir</label>
                        <input type="number" name="tahun_lahir" value="{{ old('tahun_lahir', $memoriam->tahun_lahir ?? '') }}"
                            placeholder="1940" min="1900" max="{{ date('Y') }}"
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Tahun Wafat</label>
                        <input type="number" name="tahun_wafat" value="{{ old('tahun_wafat', $memoriam->tahun_wafat ?? '') }}"
                            placeholder="2020" min="1900" max="{{ date('Y') }}"
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Urutan Tampil</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $memoriam->urutan ?? '') }}"
                            placeholder="1" min="1"
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Biografi</label>
                    <textarea name="biografi" rows="6"
                        placeholder="Tulis biografi singkat tokoh..."
                        class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('biografi', $memoriam->biografi ?? '') }}</textarea>
                </div>

            </div>
        </div>

        {{-- Wasiat / Quotes --}}
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6"
            x-data="{ quotes: {{ json_encode(old('quotes', $isEdit ? $memoriam->quotes->pluck('quote')->toArray() : [''])) }} }">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                <h3 class="font-bold text-stone-800 text-sm">Wasiat / Pesan</h3>
                <button type="button" @click="quotes.push('')"
                    class="text-xs font-semibold text-emerald-600 hover:text-emerald-800 transition-colors inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </button>
            </div>
            <div class="space-y-3">
                <template x-for="(quote, i) in quotes" :key="i">
                    <div class="flex gap-2">
                        <textarea :name="`quotes[${i}]`" x-model="quotes[i]" rows="2"
                            placeholder="Tulis wasiat atau pesan tokoh..."
                            class="flex-1 border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none"></textarea>
                        <button type="button" @click="quotes.splice(i, 1)"
                            x-show="quotes.length > 1"
                            class="w-8 h-8 mt-1 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors text-red-400 flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        {{-- Foto album yang sudah ada --}}
        @if($isEdit && $memoriam->photos->count())
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
            <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Foto Album Saat Ini</h3>
            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                @foreach($memoriam->photos as $photo)
                <div class="relative group">
                    <img src="{{ Storage::url($photo->foto) }}"
                        class="w-full aspect-square object-cover rounded-xl border border-stone-100">
                    @if($photo->keterangan)
                    <p class="text-[10px] text-stone-400 mt-1 truncate">{{ $photo->keterangan }}</p>
                    @endif
                    <label class="absolute top-1.5 right-1.5 w-6 h-6 rounded-lg bg-white/90 border border-red-200 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
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

        {{-- Upload foto album baru --}}
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6"
            x-data="{ files: [] }">
            <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">
                {{ $isEdit ? 'Tambah Foto Album' : 'Upload Foto Album' }}
            </h3>
            <input type="file" name="foto_album[]" accept="image/*" multiple
                @change="files = Array.from($event.target.files)"
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
            <div x-show="files.length" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-3">
                <template x-for="(file, i) in files" :key="i">
                    <div>
                        <div class="w-full aspect-square rounded-xl bg-stone-100 overflow-hidden border border-stone-200">
                            <img :src="URL.createObjectURL(file)" class="w-full h-full object-cover">
                        </div>
                        <input type="text" :name="`keterangan[${i}]`"
                            placeholder="Keterangan..."
                            class="mt-1 w-full border border-stone-200 rounded-lg px-2 py-1 text-[11px] text-stone-600 focus:outline-none focus:border-emerald-400 transition-all">
                    </div>
                </template>
            </div>
        </div>

    </div>

    {{-- Kolom kanan --}}
    <div class="space-y-5">

        {{-- Foto utama --}}
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
            <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Foto Utama</h3>
            @if($isEdit && $memoriam->foto)
            <div class="mb-3">
                <img src="{{ Storage::url($memoriam->foto) }}"
                    class="w-full aspect-square object-cover rounded-xl border border-stone-100">
                <p class="text-[11px] text-stone-400 mt-1.5">Upload baru untuk mengganti.</p>
            </div>
            @endif
            <input type="file" name="foto" accept="image/*"
                class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
            @error('foto') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

    </div>

</div>


