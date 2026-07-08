@extends('admin.layouts.app')
@section('title', 'Alumni')
@section('page_title', 'Manajemen Alumni')
@section('breadcrumb')
    <span class="text-emerald-600 font-medium">Alumni</span>
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Daftar Alumni</h2>
        <div class="flex items-center gap-3 mt-1">
            <span class="text-[11px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $totalAlumni }} alumni</span>
            <span class="text-[11px] font-semibold text-stone-400 bg-stone-100 px-2 py-0.5 rounded-full">{{ $totalAngkatan }} angkatan</span>
        </div>
    </div>
    <a href="{{ route('admin.alumni.create') }}"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Alumni
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Nama</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Tahun Angkatan</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Keterangan</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            @forelse($alumnis as $item)
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <p class="font-semibold text-stone-800 text-xs">{{ $item->nama }}</p>
                </td>
                <td class="py-3.5">
                    <span class="text-[11px] font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">
                        {{ $item->tahun_angkatan }}
                    </span>
                </td>
                <td class="py-3.5 text-xs text-stone-400">{{ $item->keterangan ?? '-' }}</td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.alumni.edit', $item) }}"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.alumni.destroy', $item) }}"
                            onsubmit="return confirm('Hapus data alumni ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors text-red-500">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-5 py-12 text-center text-stone-300 text-sm">Belum ada data alumni</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($alumnis->hasPages())
    <div class="px-5 py-4 border-t border-stone-100">{{ $alumnis->links() }}</div>
    @endif
</div>

@endsection