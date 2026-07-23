@extends('admin.layouts.app')
@section('title', 'Edit Prestasi')
@section('page_title', 'Edit Prestasi')
@section('breadcrumb')
    <a href="{{ route('admin.prestasi.index') }}" class="hover:text-emerald-600 transition-colors">Prestasi</a>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-emerald-600 font-medium">Edit</span>
@endsection
@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.prestasi.update', $prestasi) }}">
        @csrf @method('PUT')
        @include('admin.prestasi._form')
        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">Perbarui</button>
            <a href="{{ route('admin.prestasi.index') }}" class="text-sm text-stone-400 hover:text-stone-600 px-4 py-2.5">Batal</a>
        </div>
    </form>
</div>
@endsection


