@extends('admin.layouts.app')
@section('title', 'Kalender Akademik')
@section('page_title', 'Kalender Akademik')
@section('breadcrumb')
    <span class="text-emerald-600 font-medium">Kalender Akademik</span>
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-bold text-stone-800">Kalender Akademik TPQ</h2>
        <p class="text-xs text-stone-400 mt-0.5">{{ $kalender->total() }} jadwal terdaftar</p>
    </div>
    <a href="{{ route('admin.kalender.create') }}"
        class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Jadwal
    </a>
</div>

<div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-stone-100 bg-stone-50/60">
                <th class="text-left text-xs font-semibold text-stone-400 px-5 py-3.5">Judul</th>
                <th class="text-left text-xs font-semibold text-stone-400 py-3.5">Tanggal</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Jenis</th>
                <th class="text-center text-xs font-semibold text-stone-400 py-3.5">Status</th>
                <th class="text-right text-xs font-semibold text-stone-400 px-5 py-3.5">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
            @forelse($kalender as $item)
            @php
                $jenisConfig = match($item->jenis) {
                    'libur'      => ['label' => 'Libur',      'class' => 'text-red-700 bg-red-50'],
                    'ujian'      => ['label' => 'Ujian',      'class' => 'text-purple-700 bg-purple-50'],
                    'wisuda'     => ['label' => 'Wisuda',     'class' => 'text-amber-700 bg-amber-50'],
                    'kegiatan'   => ['label' => 'Kegiatan',   'class' => 'text-blue-700 bg-blue-50'],
                    'pengumuman' => ['label' => 'Pengumuman', 'class' => 'text-emerald-700 bg-emerald-50'],
                    default      => ['label' => $item->jenis, 'class' => 'text-stone-600 bg-stone-100'],
                };
            @endphp
            <tr class="hover:bg-stone-50/50 transition-colors">
                <td class="px-5 py-3.5">
                    <p class="font-semibold text-stone-800 text-xs">{{ $item->judul }}</p>
                    @if($item->keterangan)
                    <p class="text-stone-400 text-[11px] mt-0.5">{{ Str::limit($item->keterangan, 60) }}</p>
                    @endif
                </td>
                <td class="py-3.5 text-xs text-stone-500">
                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                    @if($item->tanggal_selesai && $item->tanggal_selesai != $item->tanggal_mulai)
                    <span class="text-stone-300 mx-1">—</span>
                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td class="py-3.5 text-center">
                    <span class="inline-flex text-[11px] font-semibold px-2.5 py-1 rounded-full {{ $jenisConfig['class'] }}">
                        {{ $jenisConfig['label'] }}
                    </span>
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
                        <a href="{{ route('admin.kalender.edit', $item) }}"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center transition-colors text-amber-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.kalender.destroy', $item) }}"
                            onsubmit="return confirm('Hapus jadwal ini?')">
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
            <tr><td colspan="5" class="px-5 py-12 text-center text-stone-300 text-sm">Belum ada jadwal</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($kalender->hasPages())
    <div class="px-5 py-4 border-t border-stone-100">{{ $kalender->links() }}</div>
    @endif
</div>

@endsection


