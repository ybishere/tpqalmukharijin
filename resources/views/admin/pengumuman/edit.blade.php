@extends('admin.layouts.app')

@section('title', 'Edit Pengumuman')
@section('page_title', 'Edit Pengumuman')

@section('breadcrumb')
    <a href="{{ route('admin.pengumuman.index') }}" class="hover:text-emerald-600 transition-colors">Pengumuman</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-emerald-600 font-medium">Edit</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.pengumuman._form')
        <div class="flex items-center gap-3 mt-6">
            <button type="submit"
                class="bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                Perbarui Pengumuman
            </button>
            <a href="{{ route('admin.pengumuman.index') }}"
                class="text-sm text-stone-400 hover:text-stone-600 transition-colors px-4 py-2.5">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection