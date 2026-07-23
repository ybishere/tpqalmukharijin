@extends('admin.layouts.app')
@section('title', 'Edit Kegiatan')
@section('page_title', 'Edit Kegiatan')
@section('breadcrumb')
    <a href="{{ route('admin.kegiatan.index') }}" class="hover:text-emerald-600 transition-colors">Kegiatan</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-emerald-600 font-medium">Edit</span>
@endsection
@section('content')
<div class="max-w-2xl">
    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('admin.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.kegiatan._form')
        <div class="flex items-center gap-3 mt-6">
            <button type="submit"
                class="bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                Perbarui Kegiatan
            </button>
            <a href="{{ route('admin.kegiatan.index') }}"
                class="text-sm text-stone-400 hover:text-stone-600 transition-colors px-4 py-2.5">Batal</a>
        </div>
    </form>
</div>
@endsection


