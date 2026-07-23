@extends('admin.layouts.app')

@section('title', 'Edit Program')
@section('page_title', 'Edit Program')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span>
    <a href="{{ route('admin.program.index') }}" class="text-emerald-600 hover:underline">Program</a>
    <span>/</span> <span>Edit</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-emerald-600 via-yellow-500 to-emerald-600"></div>
        <div class="p-6">

            <form method="POST" action="{{ route('admin.program.update', $program) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Program <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_program" value="{{ old('nama_program', $program->nama_program) }}"
                        class="w-full border {{ $errors->has('nama_program') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('nama_program') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full border {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Alasan Donasi
        <span class="text-gray-400 font-normal">(opsional)</span>
    </label>
    <p class="text-xs text-gray-400 mb-2">Ceritakan kenapa program ini membutuhkan donasi — semakin detail semakin baik.</p>
    <textarea name="alasan_donasi" rows="6"
        class="w-full border {{ $errors->has('alasan_donasi') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all resize-none">{{ old('alasan_donasi', $program->alasan_donasi) }}</textarea>
    @error('alasan_donasi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Deadline
        <span class="text-gray-400 font-normal">(opsional)</span>
    </label>
    <p class="text-xs text-gray-400 mb-2">Batas waktu kebutuhan dana — menciptakan urgensi bagi donatur.</p>
    <input type="date" name="deadline" value="{{ old('deadline', $program->deadline) }}"
        class="w-full border {{ $errors->has('deadline') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
    @error('deadline') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
</div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Target Dana (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="target_dana" value="{{ old('target_dana', $program->target_dana) }}"
                        class="w-full border {{ $errors->has('target_dana') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('target_dana') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                        <option value="aktif"   {{ old('status', $program->status) == 'aktif'   ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ old('status', $program->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto Program</label>
                    @if ($program->foto)
                        <img src="{{ Storage::url($program->foto) }}" class="w-32 h-24 object-cover rounded-xl mb-3">
                        <p class="text-xs text-gray-400 mb-2">Upload foto baru untuk mengganti foto lama.</p>
                    @endif
                    <input type="file" name="foto" accept="image/*" onchange="previewFoto(this)"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition-all file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                    <img id="fotoPreview" src="" class="mt-3 w-32 h-24 object-cover rounded-xl hidden">
                    @error('foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.program.index') }}"
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
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection


