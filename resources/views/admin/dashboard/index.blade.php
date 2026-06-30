@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span>
    <span>/</span>
    <span>Dashboard</span>
@endsection

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-800">{{ \App\Models\Program::count() }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Program</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-800">{{ \App\Models\Donasi::where('status_bayar','sukses')->count() }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Donasi Masuk</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-amber-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-800">
            Rp {{ number_format(\App\Models\Donasi::where('status_bayar','sukses')->sum('jumlah'), 0, ',', '.') }}
        </p>
        <p class="text-sm text-gray-500 mt-1">Total Dana Terkumpul</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="w-11 h-11 rounded-xl bg-purple-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-800">
            Rp {{ number_format(\App\Models\Penggunaan::sum('jumlah'), 0, ',', '.') }}
        </p>
        <p class="text-sm text-gray-500 mt-1">Total Dana Tersalurkan</p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    <div class="lg:col-span-2 bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <h3 class="font-bold text-gray-800 mb-1">Donasi Terbaru</h3>
        <p class="text-xs text-gray-400 mb-4">10 transaksi terakhir</p>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-xs font-semibold text-gray-500 pb-2">Donatur</th>
                        <th class="text-left text-xs font-semibold text-gray-500 pb-2">Program</th>
                        <th class="text-right text-xs font-semibold text-gray-500 pb-2">Jumlah</th>
                        <th class="text-right text-xs font-semibold text-gray-500 pb-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse(\App\Models\Donasi::with('program')->where('status_bayar','sukses')->latest()->take(10)->get() as $d)
                    <tr>
                        <td class="py-2.5 font-medium text-gray-800">{{ $d->nama_donatur ?? 'Anonim' }}</td>
                        <td class="py-2.5 text-gray-500 truncate max-w-[120px]">{{ $d->program->nama ?? '-' }}</td>
                        <td class="py-2.5 text-right text-emerald-600 font-semibold">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                        <td class="py-2.5 text-right text-gray-400 text-xs">{{ $d->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-8 text-center text-gray-400">Belum ada donasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <h3 class="font-bold text-gray-800 mb-4">Program Aktif</h3>
        <div class="space-y-3">
            @forelse(\App\Models\Program::where('status','aktif')->take(5)->get() as $p)
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold text-gray-700 truncate">{{ $p->nama }}</p>
                    <span class="text-[10px] text-emerald-600 font-bold ml-2 flex-shrink-0">
                        {{ $p->target_dana > 0 ? min(100, round(($p->dana_terkumpul / $p->target_dana) * 100)) : 0 }}%
                    </span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-emerald-500 h-1.5 rounded-full"
                        style="width: {{ $p->target_dana > 0 ? min(100, round(($p->dana_terkumpul / $p->target_dana) * 100)) : 0 }}%">
                    </div>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">Belum ada program aktif</p>
            @endforelse
        </div>
    </div>

</div>

@endsection