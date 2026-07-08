@extends('admin.layouts.app')

@section('title', 'Pengumuman')
@section('page_title', 'Manajemen Pengumuman')

@section('breadcrumb')
    <span class="text-emerald-600 font-medium">Pengumuman</span>
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Daftar Pengumuman</h2>
        <p class="text-xs text-stone-400 mt-0.5">{{ $announcements->total() }} total pengumuman</p>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Pengumuman
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Judul</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Tanggal Publish</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Status</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            @forelse($announcements as $item)
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}"
                            class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-stone-100">
                        @else
                        <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-semibold text-stone-800 text-xs truncate max-w-[280px]">{{ $item->judul }}</p>
                            <p class="text-stone-400 text-[11px] mt-0.5">{{ Str::limit(strip_tags($item->isi), 60) }}</p>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 text-xs text-stone-500">
                    {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                </td>
                <td class="py-3.5 text-center">
                    @if($item->is_active)
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-stone-400 bg-stone-100 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-stone-300"></span> Nonaktif
                        </span>
                    @endif
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.pengumuman.edit', $item) }}"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.pengumuman.destroy', $item) }}"
                            onsubmit="return confirm('Hapus pengumuman ini?')">
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
            <tr>
                <td colspan="4" class="px-5 py-12 text-center text-stone-300 text-sm">
                    Belum ada pengumuman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($announcements->hasPages())
    <div class="px-5 py-4 border-t border-stone-100">
        {{ $announcements->links() }}
    </div>
    @endif
</div>

@endsection