@extends('admin.layouts.app')

@section('title', 'Catat Penggunaan Dana')
@section('page_title', 'Catat Penggunaan Dana')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span>
    <a href="{{ route('admin.penggunaan.index') }}" class="text-emerald-600 hover:underline">Penggunaan Dana</a>
    <span>/</span> <span>Catat</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-emerald-600 via-yellow-500 to-emerald-600"></div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.penggunaan.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Program <span class="text-red-500">*</span></label>
                    <select name="program_id"
                        class="w-full border {{ $errors->has('program_id') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                        <option value="">— Pilih Program —</option>
                        @foreach ($programs as $p)
                            <option value="{{ $p->id_program }}" {{ old('program_id') == $p->id_program ? 'selected' : '' }}>
                                {{ $p->nama_program }}
                            </option>
                        @endforeach
                    </select>
                    @error('program_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Uraian Penggunaan <span class="text-red-500">*</span></label>
                    <textarea name="uraian" rows="4"
                        placeholder="Contoh: Pembelian 20 Al-Qur'an untuk santri kelas 3..."
                        class="w-full border {{ $errors->has('uraian') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('uraian') }}</textarea>
                    @error('uraian') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" value="{{ old('jumlah') }}"
                        placeholder="500000"
                        class="w-full border {{ $errors->has('jumlah') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('jumlah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bukti Foto</label>
                    <input type="file" name="bukti_foto" accept="image/*" onchange="previewFoto(this)"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 2MB.</p>
                    @error('bukti_foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    <img id="fotoPreview" src="" class="mt-3 w-32 h-24 object-cover rounded-xl hidden">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-colors shadow-sm">
                        Simpan
                    </button>
                    <a href="{{ route('admin.penggunaan.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewFoto(input) {
    const preview = document.getElementById('fotoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection