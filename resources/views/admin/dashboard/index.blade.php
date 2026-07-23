@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('breadcrumb')
    <span class="text-emerald-600 font-medium">Dashboard</span>
@endsection

@section('content')

{{-- Stat Cards --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-2xl p-5 border border-stone-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Aktif</span>
        </div>
        <p class="text-2xl font-extrabold text-stone-800">{{ \App\Models\Student::where('is_active', true)->count() }}</p>
        <p class="text-xs text-stone-400 mt-0.5">Total Santri Aktif</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-stone-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Total</span>
        </div>
        <p class="text-2xl font-extrabold text-stone-800">{{ \App\Models\Alumni::count() }}</p>
        <p class="text-xs text-stone-400 mt-0.5">Total Alumni</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-stone-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <span class="text-[10px] font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">Sukses</span>
        </div>
        <p class="text-2xl font-extrabold text-stone-800">{{ \App\Models\Donasi::where('status_bayar','sukses')->count() }}</p>
        <p class="text-xs text-stone-400 mt-0.5">Total Donasi Masuk</p>
    </div>

    <div class="bg-white rounded-2xl p-5 border border-stone-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-[10px] font-semibold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">Terkumpul</span>
        </div>
        <p class="text-2xl font-extrabold text-stone-800">
            Rp {{ number_format(\App\Models\Donasi::where('status_bayar','sukses')->sum('jumlah'), 0, ',', '.') }}
        </p>
        <p class="text-xs text-stone-400 mt-0.5">Total Dana Terkumpul</p>
    </div>

</div>

{{-- Row 2: Dana banner + quick stats --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Dana banner --}}
    <div class="lg:col-span-2 rounded-2xl p-6 relative overflow-hidden"
        style="background:linear-gradient(135deg,#022c22 0%,#064e3b 60%,#065f46 100%);">
        <div class="absolute inset-0 opacity-20"
            style="background-image:url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M30 0l7.5 13H22.5L30 0zm0 60L22.5 47h15L30 60zM0 30l13-7.5V37.5L0 30zm60 0L47 37.5V22.5L60 30z'/%3E%3C/g%3E%3C/svg%3E\");">
        </div>
        @php
            $totalDana   = \App\Models\Donasi::where('status_bayar','sukses')->sum('jumlah');
            $totalTarget = \App\Models\Program::where('status','aktif')->sum('target_dana');
            $totalKeluar = \App\Models\Penggunaan::sum('jumlah');
            $saldo       = $totalDana - $totalKeluar;
            $persen      = $totalTarget > 0 ? min(100, round(($totalDana / $totalTarget) * 100)) : 0;
        @endphp
        <div class="relative">
            <p class="text-white/50 text-xs uppercase tracking-widest font-semibold mb-1">Ringkasan Keuangan</p>
            <p class="text-white font-extrabold text-2xl mb-4">Rp {{ number_format($totalDana, 0, ',', '.') }}
                <span class="text-white/40 text-sm font-normal">terkumpul</span>
            </p>
            <div class="h-1.5 rounded-full mb-2" style="background:rgba(255,255,255,0.1)">
                <div class="h-full rounded-full" style="width:{{ $persen }}%;background:linear-gradient(90deg,#10b981,#fbbf24);transition:width 1s ease;"></div>
            </div>
            <div class="flex items-center justify-between text-xs text-white/50 mb-4">
                <span>{{ $persen }}% dari target</span>
                <span>Target: Rp {{ number_format($totalTarget, 0, ',', '.') }}</span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-xl px-4 py-3" style="background:rgba(255,255,255,0.07)">
                    <p class="text-white/40 text-[10px] uppercase tracking-wide mb-0.5">Dana Keluar</p>
                    <p class="text-white font-bold text-sm">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-xl px-4 py-3" style="background:rgba(16,185,129,0.15)">
                    <p class="text-emerald-300/70 text-[10px] uppercase tracking-wide mb-0.5">Saldo</p>
                    <p class="text-emerald-300 font-bold text-sm">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick stats --}}
    <div class="flex flex-col gap-4">
        <div class="bg-white rounded-2xl p-4 border border-stone-100 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-stone-800">{{ \App\Models\Program::where('status','aktif')->count() }}</p>
                <p class="text-xs text-stone-400">Program Aktif</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-stone-100 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-stone-800">{{ \App\Models\Activity::where('status','akan_datang')->count() }}</p>
                <p class="text-xs text-stone-400">Kegiatan Akan Datang</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-stone-100 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-extrabold text-stone-800">{{ \App\Models\Announcement::where('is_active', true)->count() }}</p>
                <p class="text-xs text-stone-400">Pengumuman Aktif</p>
            </div>
        </div>
    </div>

</div>

{{-- Row 3: Donasi terbaru + Program progress --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Donasi terbaru --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-stone-100">
            <div>
                <h3 class="font-bold text-stone-800 text-sm">Donasi Terbaru</h3>
                <p class="text-[11px] text-stone-400 mt-0.5">10 transaksi terakhir</p>
            </div>
            <a href="{{ route('admin.donasi.index') }}"
                class="text-xs font-semibold text-emerald-600 hover:text-emerald-800 transition-colors">
                Lihat semua →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stone-50 bg-stone-50/50">
                        <th class="text-left text-[11px] font-semibold text-stone-400 px-5 py-3">Donatur</th>
                        <th class="text-left text-[11px] font-semibold text-stone-400 py-3">Program</th>
                        <th class="text-right text-[11px] font-semibold text-stone-400 py-3">Jumlah</th>
                        <th class="text-right text-[11px] font-semibold text-stone-400 px-5 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-50">
                    @forelse(\App\Models\Donasi::with('program')->where('status_bayar','sukses')->latest()->take(10)->get() as $d)
                    <tr class="hover:bg-stone-50/50 transition-colors">
                        <td class="px-5 py-3 font-medium text-stone-800 text-xs">{{ $d->nama_donatur ?? 'Anonim' }}</td>
                        <td class="py-3 text-stone-400 text-xs truncate max-w-[140px]">{{ $d->program->nama_program ?? '-' }}</td>
                        <td class="py-3 text-right text-emerald-600 font-bold text-xs">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-right text-stone-300 text-xs">{{ $d->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-5 py-10 text-center text-stone-300 text-sm">Belum ada donasi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Program progress --}}
    <div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-stone-100">
            <div>
                <h3 class="font-bold text-stone-800 text-sm">Program Aktif</h3>
                <p class="text-[11px] text-stone-400 mt-0.5">Progress pencapaian</p>
            </div>
            <a href="{{ route('admin.program.index') }}"
                class="text-xs font-semibold text-emerald-600 hover:text-emerald-800 transition-colors">
                Kelola →
            </a>
        </div>
        <div class="p-5 space-y-4">
            @forelse(\App\Models\Program::where('status','aktif')->take(5)->get() as $p)
            @php $pct = $p->target_dana > 0 ? min(100, round(($p->dana_terkumpul / $p->target_dana) * 100)) : 0; @endphp
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <p class="text-xs font-semibold text-stone-700 truncate flex-1 mr-2">{{ $p->nama_program }}</p>
                    <span class="text-[11px] font-bold {{ $pct >= 75 ? 'text-emerald-600' : ($pct >= 40 ? 'text-amber-600' : 'text-stone-400') }} flex-shrink-0">
                        {{ $pct }}%
                    </span>
                </div>
                <div class="h-1.5 bg-stone-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-700"
                        style="width:{{ $pct }}%;background:{{ $pct >= 75 ? 'linear-gradient(90deg,#10b981,#059669)' : ($pct >= 40 ? 'linear-gradient(90deg,#f59e0b,#d97706)' : '#e5e7eb') }}">
                    </div>
                </div>
                <p class="text-[10px] text-stone-300 mt-1">
                    Rp {{ number_format($p->dana_terkumpul, 0, ',', '.') }} / Rp {{ number_format($p->target_dana, 0, ',', '.') }}
                </p>
            </div>
            @empty
            <p class="text-sm text-stone-300 text-center py-6">Belum ada program aktif</p>
            @endforelse
        </div>
    </div>

</div>

@endsection


