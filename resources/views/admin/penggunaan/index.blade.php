@extends('admin.layouts.app')

@section('title', 'Penggunaan Dana')
@section('page_title', 'Penggunaan Dana')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span> <span>Penggunaan Dana</span>
@endsection

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Disalurkan</p>
        <p class="text-2xl font-extrabold text-purple-600">Rp {{ number_format($totalDisalurkan, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Transaksi</p>
        <p class="text-2xl font-extrabold text-gray-800">{{ $penggunaans->total() }}</p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Program Terlibat</p>
        <p class="text-2xl font-extrabold text-gray-800">{{ $programs->count() }}</p>
    </div>
</div>

{{-- Filter + Tambah --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-5 p-4">
    <form method="GET" action="{{ route('admin.penggunaan.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Cari Uraian</label>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Kata kunci uraian..."
                class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
        </div>
        <div class="min-w-[180px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Program</label>
            <select name="program_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                <option value="">Semua Program</option>
                @foreach ($programs as $p)
                    <option value="{{ $p->id_program }}" {{ request('program_id') == $p->id_program ? 'selected' : '' }}>
                        {{ $p->nama_program }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                Filter
            </button>
            @if(request()->hasAny(['search','program_id']))
                <a href="{{ route('admin.penggunaan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                    Reset
                </a>
            @endif
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.penggunaan.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Catat Penggunaan
            </a>
        </div>
    </form>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Uraian</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Program</th>
                    <th class="text-right text-xs font-semibold text-gray-500 px-5 py-3.5">Jumlah</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Bukti</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Tanggal</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($penggunaans as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="font-medium text-gray-800 max-w-[240px]">{{ Str::limit($p->uraian, 60) }}</p>
                    </td>
                    <td class="px-5 py-4 text-gray-500">
                        <span class="truncate block max-w-[140px]">{{ $p->program->nama_program ?? '-' }}</span>
                    </td>
                    <td class="px-5 py-4 text-right font-semibold text-purple-600">
                        Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                    </td>
                    <td class="px-5 py-4">
                        @if ($p->bukti_foto)
                            <a href="{{ Storage::url($p->bukti_foto) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-xs text-blue-600 hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat
                            </a>
                        @else
                            <span class="text-xs text-gray-300">—</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-gray-400 text-xs">{{ $p->created_at->format('d/m/Y') }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.penggunaan.show', $p) }}"
                                class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.penggunaan.edit', $p) }}"
                                class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 flex items-center justify-center text-amber-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.penggunaan.destroy', $p) }}"
                                onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center text-gray-400">Belum ada data penggunaan dana</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($penggunaans->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">{{ $penggunaans->links() }}</div>
    @endif
</div>

@endsection


