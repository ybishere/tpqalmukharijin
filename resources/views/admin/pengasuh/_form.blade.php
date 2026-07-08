@php $isEdit = isset($pengasuh); @endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
            <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Informasi</h3>
            <div class="space-y-4">

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $pengasuh->nama ?? '') }}"
                        placeholder="Nama lengkap..."
                        class="w-full border {{ $errors->has('nama') ? 'border-red-300 bg-red-50' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Jabatan</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan', $pengasuh->jabatan ?? '') }}"
                            placeholder="Contoh: Ketua TPQ..."
                            class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-stone-600 mb-1.5">Status <span class="text-red-400">*</span></label>
                        <select name="status"
                            class="w-full border {{ $errors->has('status') ? 'border-red-300' : 'border-stone-200' }} rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                            <option value="Pengasuh" {{ old('status', $pengasuh->status ?? '') === 'Pengasuh' ? 'selected' : '' }}>Pengasuh</option>
                            <option value="Pengajar" {{ old('status', $pengasuh->status ?? '') === 'Pengajar' ? 'selected' : '' }}>Pengajar</option>
                        </select>
                        @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Urutan Tampil</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $pengasuh->urutan ?? '') }}"
                        placeholder="1" min="1"
                        class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Keterangan</label>
                    <textarea name="keterangan" rows="4"
                        placeholder="Keterangan singkat..."
                        class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('keterangan', $pengasuh->keterangan ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-stone-600 mb-1.5">Quotes / Motto</label>
                    <textarea name="quotes" rows="2"
                        placeholder="Quotes atau motto..."
                        class="w-full border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-800 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('quotes', $pengasuh->quotes ?? '') }}</textarea>
                    @error('quotes') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>
    </div>

    {{-- Kolom kanan: foto --}}
    <div>
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6">
            <h3 class="font-bold text-stone-800 text-sm mb-4 pb-3 border-b border-stone-100">Foto</h3>
            @if($isEdit && $pengasuh->foto)
            <div class="mb-3">
                <img src="{{ Storage::url($pengasuh->foto) }}"
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