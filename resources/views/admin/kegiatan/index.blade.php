@extends('admin.layouts.app')

@section('title', 'Kegiatan')
@section('page_title', 'Manajemen Kegiatan')

@section('breadcrumb')
    <span class="text-emerald-600 font-medium">Kegiatan</span>
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Daftar Kegiatan</h2>
        <p class="text-xs text-stone-400 mt-0.5">{{ $activities->total() }} total kegiatan</p>
    </div>
    <a href="{{ route('admin.kegiatan.create') }}"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Kegiatan
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Kegiatan</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Tanggal</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Foto</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Status</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            @forelse($activities as $item)
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}"
                            class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-stone-100">
                        @else
                        <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-semibold text-stone-800 text-xs truncate max-w-[240px]">{{ $item->judul }}</p>
                            <p class="text-stone-400 text-[11px] mt-0.5">{{ Str::limit($item->deskripsi, 55) }}</p>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 text-xs text-stone-500">
                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                </td>
                <td class="py-3.5 text-center">
                    <span class="text-xs font-semibold text-stone-500">{{ $item->photos_count }} foto</span>
                </td>
                <td class="py-3.5 text-center">
                    @php
                        $badge = match($item->status) {
                            'akan_datang' => ['label' => 'Akan Datang', 'class' => 'text-blue-700 bg-blue-50'],
                            'berlangsung' => ['label' => 'Berlangsung', 'class' => 'text-amber-700 bg-amber-50'],
                            'selesai'     => ['label' => 'Selesai',     'class' => 'text-emerald-700 bg-emerald-50'],
                            default       => ['label' => $item->status, 'class' => 'text-stone-500 bg-stone-100'],
                        };
                    @endphp
                    <span class="inline-flex text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $badge['class'] }}">
                        {{ $badge['label'] }}
                    </span>
                </td>
                <td class="px-5 py-3.5">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.kegiatan.edit', $item) }}"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}"
                            onsubmit="return confirm('Hapus kegiatan ini beserta semua fotonya?')">
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
                <td colspan="5" class="px-5 py-12 text-center text-stone-300 text-sm">Belum ada kegiatan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($activities->hasPages())
    <div class="px-5 py-4 border-t border-stone-100">{{ $activities->links() }}</div>
    @endif
</div>

@endsection