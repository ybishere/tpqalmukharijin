@extends('layouts.app')
@section('title', $pengumuman->judul . ' – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative pt-32 pb-16 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 50%,#064e3b 100%);">
    <div class="pattern-bg absolute inset-0 opacity-25"></div>
    <div class="absolute top-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.4),transparent)"></div>

    <div class="relative max-w-6xl mx-auto px-6">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-white/40 text-xs mb-8">
            <a href="{{ route('beranda') }}" class="hover:text-white/70 transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('pengumuman.index') }}" class="hover:text-white/70 transition-colors">Pengumuman</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60 line-clamp-1">{{ Str::limit($pengumuman->judul, 40) }}</span>
        </div>

        <div class="max-w-3xl">
            <span class="badge badge-amber mb-4">📢 Pengumuman</span>
            <h1 class="font-extrabold text-white leading-tight mb-4"
                style="font-size:clamp(1.8rem,4vw,3rem);">
                {{ $pengumuman->judul }}
            </h1>
            <p class="text-white/50 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::parse($pengumuman->tanggal_publish)->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>
</section>

{{-- ═══ KONTEN ═══ --}}
<section class="py-16 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-3 gap-12">

            {{-- Isi --}}
            <div class="lg:col-span-2">
                @if($pengumuman->thumbnail)
                <div class="rounded-2xl overflow-hidden mb-8 shadow-sm">
                    <img src="{{ Storage::url($pengumuman->thumbnail) }}" alt="{{ $pengumuman->judul }}"
                        class="w-full object-cover" style="max-height:400px;">
                </div>
                @endif

                <div class="bg-white rounded-2xl border border-stone-100 p-8 shadow-sm">
                    <div class="prose prose-stone max-w-none text-stone-600 leading-relaxed">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>
                </div>

                {{-- Navigasi --}}
                <div class="mt-6 flex items-center justify-between gap-4">
                    <a href="{{ route('pengumuman.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-stone-500 hover:text-emerald-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Pengumuman
                    </a>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1 space-y-5">

                {{-- Info --}}
                <div class="bg-white rounded-2xl border border-stone-100 p-6 shadow-sm">
                    <h3 class="font-bold text-stone-900 text-sm mb-4">Informasi</h3>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-0.5">Tanggal Publish</p>
                                <p class="text-stone-700 text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($pengumuman->tanggal_publish)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-0.5">Status</p>
                                <span class="{{ $pengumuman->is_active ? 'badge badge-green' : 'badge badge-blue' }}">
                                    {{ $pengumuman->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pengumuman lainnya --}}
                @if($lainnya->count())
                <div class="bg-white rounded-2xl border border-stone-100 p-5 shadow-sm">
                    <h3 class="font-bold text-stone-900 text-sm mb-4">Pengumuman Lainnya</h3>
                    <div class="space-y-3">
                        @foreach($lainnya as $item)
                        <a href="{{ route('pengumuman.show', $item->id) }}"
                            class="flex gap-3 items-start group">
                            <div class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-[10px] font-bold"
                                style="background:#f0fdf4;color:#15803d;">
                                {{ $loop->iteration }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-stone-800 text-xs font-semibold leading-snug line-clamp-2 group-hover:text-emerald-800 transition-colors">
                                    {{ $item->judul }}
                                </p>
                                <p class="text-stone-400 text-[10px] mt-0.5">
                                    {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection