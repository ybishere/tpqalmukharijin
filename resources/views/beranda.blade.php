@extends('layouts.app')
@section('title', 'Beranda – TPQ Al-Mukharijin')

@section('meta_description', 'TPQ Al-Mukharijin Desa Kreman, Kec. Warureja, Kab. Tegal. Lembaga pendidikan Al-Quran yang mendidik generasi Qurani sejak 1991.')
@section('og_title', 'TPQ Al-Mukharijin – Tempat Belajar Al-Quran Desa Kreman')
@section('og_description', 'Mendidik generasi Qurani yang berakhlak mulia, cerdas, dan bermanfaat bagi agama dan masyarakat.')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-screen overflow-hidden"
    style="background: linear-gradient(135deg, #011a10 0%, #022c22 40%, #064e3b 100%);">

    <div class="pattern-bg absolute inset-0 opacity-30"></div>
    <div class="absolute -top-32 -right-32 w-[500px] h-[500px] rounded-full"
        style="background: radial-gradient(circle, rgba(16,185,129,0.07) 0%, transparent 70%)"></div>
    <div class="absolute -bottom-32 -left-32 w-[400px] h-[400px] rounded-full"
        style="background: radial-gradient(circle, rgba(245,158,11,0.05) 0%, transparent 70%)"></div>

    <div class="relative max-w-6xl mx-auto px-6 min-h-screen flex flex-col justify-center py-32">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-12 hero-animate">
            <p class="font-arabic text-amber-300/80 text-2xl md:text-3xl leading-loose">
                اِقْرَأْ بِاسْمِ رَبِّكَ الَّذِيْ خَلَقَ
            </p>
            <div class="flex items-center gap-2.5"
                style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-radius:100px;padding:6px 16px;width:fit-content;">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                <span class="text-white/60 text-xs font-medium">Desa Kreman, Kec. Warureja, Kab. Tegal, Jawa Tengah</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start">

            {{-- Kiri --}}
            <div>
                <h1 class="hero-animate font-extrabold text-white leading-[1.08] mb-8"
                    style="font-size:clamp(2.8rem,6vw,4.5rem);">
                    Tempat<br>Belajar<br>
                    <span style="background:linear-gradient(90deg,#fcd34d 0%,#f59e0b 40%,#10b981 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Al‑Quran</span>
                </h1>
                <div class="hero-animate w-16 h-0.5 mb-8" style="background:linear-gradient(90deg,#f59e0b,transparent)"></div>
                <div class="hero-animate space-y-4 mb-10">
                    <p class="text-white/60 text-base leading-relaxed">
                        TPQ Al-Mukharijin berdiri sebagai lembaga pendidikan Al-Quran yang membimbing
                        anak-anak Desa Kreman dalam membaca Al-Quran dengan tartil, membangun akhlak
                        mulia, dan mencintai ilmu agama sejak dini.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-1">
                        @foreach(['Tartil & Tajwid','Akhlakul Karimah','Hafalan Juz Amma','Pendidikan Agama'] as $tag)
                        <span style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#6ee7b7;font-size:11px;font-weight:600;padding:4px 12px;border-radius:100px;">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="hero-animate flex flex-wrap gap-3">
                    <a href="{{ route('profil.index') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Profil TPQ
                    </a>
                    <a href="{{ route('kegiatan.index') }}" class="btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Lihat Kegiatan
                    </a>
                </div>
            </div>

            {{-- Kanan: Slider --}}
            {{-- Kanan: Slider --}}
<div class="hero-animate relative hidden lg:block"
    x-data="slider()" x-init="init()">
    <div class="relative overflow-hidden rounded-3xl"
        style="aspect-ratio:4/3;box-shadow:0 40px 80px rgba(0,0,0,0.5);">

        @if($kegiatanSlider->count())
        <div class="flex h-full transition-transform duration-700 ease-in-out"
            :style="`transform:translateX(-${current*100}%);width:${slides.length*100}%`">
            @foreach($kegiatanSlider as $slide)
            <div class="h-full relative flex-shrink-0" style="width:{{ 100 / $kegiatanSlider->count() }}%">
                <img src="{{ Storage::url($slide->thumbnail) }}"
                    alt="{{ $slide->judul }}"
                    class="absolute inset-0 w-full h-full object-cover">
            </div>
            @endforeach
        </div>
        @else
        {{-- Fallback kalau belum ada foto sama sekali --}}
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 to-emerald-700 flex flex-col items-center justify-center gap-3">
            <div class="pattern-bg absolute inset-0 opacity-20"></div>
            <svg class="w-16 h-16 text-white/20 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
            </svg>
            <p class="text-white/30 text-sm relative z-10">Foto kegiatan belum tersedia</p>
        </div>
        @endif

        <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(0,0,0,0.7) 0%,transparent 50%)"></div>

        {{-- Info kegiatan di bawah slide --}}
        @if($kegiatanSlider->count())
        <div class="absolute bottom-0 left-0 right-0 p-6">
            <p class="text-white/50 text-[10px] uppercase tracking-widest font-semibold mb-1">Kegiatan</p>
            <p class="text-white font-bold text-base" x-text="labels[current]"></p>
            <div class="flex items-center justify-between mt-3">
                <div class="flex gap-1.5">
                    <template x-for="(s,i) in slides" :key="i">
                        <button @click="goTo(i)"
                            class="rounded-full transition-all duration-300"
                            :class="i===current?'w-5 h-2 bg-white':'w-2 h-2 bg-white/40 hover:bg-white/70'">
                        </button>
                    </template>
                </div>
                <div class="flex gap-2">
                    <button @click="prev()" class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                        style="background:rgba(255,255,255,0.15);backdrop-filter:blur(8px);"
                        onmouseenter="this.style.background='rgba(255,255,255,0.25)'"
                        onmouseleave="this.style.background='rgba(255,255,255,0.15)'">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()" class="w-8 h-8 rounded-full flex items-center justify-center transition-all"
                        style="background:rgba(255,255,255,0.15);backdrop-filter:blur(8px);"
                        onmouseenter="this.style.background='rgba(255,255,255,0.25)'"
                        onmouseleave="this.style.background='rgba(255,255,255,0.15)'">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 text-white/25">
        <span class="text-[10px] tracking-[0.3em] uppercase">Scroll</span>
        <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ═══ FOTO MADRASAH ═══ --}}
<section class="relative h-[500px] md:h-[580px] overflow-hidden">
    <div class="absolute inset-0">
    <img src="{{ asset('images/gedung-tpq.jpg') }}"
        alt="TPQ Al-Mukharijin"
        class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0" style="background:linear-gradient(to right,rgba(1,26,16,0.92) 0%,rgba(1,26,16,0.6) 55%,rgba(1,26,16,0.3) 100%)"></div>
    <div class="relative h-full max-w-6xl mx-auto px-6 flex items-center">
        <div class="max-w-xl">
            <span class="section-label mb-5 block" style="color:#fbbf24;">Tentang Kami</span>
            <h2 class="font-extrabold text-white leading-tight mb-6 fade-up"
                style="font-size:clamp(1.8rem,4vw,3rem);">
                Lebih dari Sekadar<br>
                <span class="text-amber-300">Tempat Mengaji</span>
            </h2>
            <p class="text-white/60 text-base leading-relaxed mb-8 fade-up">
                TPQ Al-Mukharijin adalah rumah kedua bagi para santri. Di sini, anak-anak tidak hanya
                belajar membaca Al-Quran, tetapi juga dididik menjadi pribadi yang berkarakter,
                berakhlak mulia, dan siap menjadi generasi penerus bangsa yang beriman.
            </p>
            <div class="flex flex-wrap gap-3 fade-up">
                <a href="{{ route('profil.index') }}"
                    style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);color:white;font-size:13px;font-weight:600;padding:10px 22px;border-radius:100px;transition:all 0.25s;text-decoration:none;backdrop-filter:blur(8px);"
                    onmouseenter="this.style.background='rgba(255,255,255,0.2)'"
                    onmouseleave="this.style.background='rgba(255,255,255,0.12)'">
                    Baca Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('profil.pengasuh') }}"
                    style="display:inline-flex;align-items:center;gap:8px;color:rgba(252,211,77,0.85);font-size:13px;font-weight:600;padding:10px 4px;border-radius:100px;transition:all 0.25s;text-decoration:none;"
                    onmouseenter="this.style.color='#fcd34d'"
                    onmouseleave="this.style.color='rgba(252,211,77,0.85)'">
                    Kenali Pengasuh →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ KEGIATAN ═══ --}}
<section class="py-24 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <span class="section-label mb-3 block">Agenda & Dokumentasi</span>
                <h2 class="font-extrabold text-stone-900 leading-tight" style="font-size:clamp(1.8rem,3vw,2.5rem);">Kegiatan Terbaru</h2>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="self-start inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-900 transition-colors group">
                Lihat semua
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if(isset($kegiatan) && $kegiatan->count())
        @php $featured = $kegiatan->first(); $rest = $kegiatan->skip(1); @endphp
        <div class="grid lg:grid-cols-5 gap-6">

            {{-- Featured card besar --}}
            <a href="{{ route('kegiatan.show', $featured->id) }}"
                class="lg:col-span-3 fade-up card group block relative overflow-hidden" style="min-height:400px;">
                @if($featured->thumbnail)
                    <img src="{{ Storage::url($featured->thumbnail) }}" alt="{{ $featured->judul }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-800 to-emerald-600 flex items-center justify-center">
                        <div class="pattern-bg absolute inset-0 opacity-20"></div>
                        <svg class="w-20 h-20 text-white/20 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                        </svg>
                    </div>
                @endif
                <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(0,0,0,0.88) 0%,rgba(0,0,0,0.2) 50%,transparent 100%)"></div>
                <div class="absolute bottom-0 left-0 right-0 p-7">
                    <span class="badge {{ $featured->status==='akan_datang'?'badge-amber':'badge-green' }} mb-3">
                        {{ $featured->status==='akan_datang'?'⏰ Akan Datang':'✓ Selesai' }}
                    </span>
                    <h3 class="text-white font-extrabold text-xl leading-tight mb-2">{{ $featured->judul }}</h3>
                    <div class="flex items-center gap-4 text-white/55 text-sm">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ \Carbon\Carbon::parse($featured->tanggal)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    @if($featured->deskripsi)
                    <p class="text-white/45 text-sm mt-2 line-clamp-2">{{ Str::limit($featured->deskripsi, 100) }}</p>
                    @endif
                </div>
            </a>

            {{-- Side --}}
            <div class="lg:col-span-2 flex flex-col gap-5">
                @foreach($rest as $item)
                <a href="{{ route('kegiatan.show', $item->id) }}" class="fade-up card group flex gap-4 p-5 items-start">
                    @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-20 h-20 rounded-xl object-cover shrink-0">
                    @else
                        <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <span class="badge {{ $item->status==='akan_datang'?'badge-amber':'badge-green' }} mb-2">
                            {{ $item->status==='akan_datang'?'Akan Datang':'Selesai' }}
                        </span>
                        <h3 class="font-bold text-stone-900 text-sm leading-snug line-clamp-2 group-hover:text-emerald-800 transition-colors">{{ $item->judul }}</h3>
                        <p class="text-stone-400 text-xs mt-1.5">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</p>
                        @if($item->deskripsi)
                        <p class="text-stone-400 text-xs mt-1 line-clamp-1">{{ Str::limit($item->deskripsi, 60) }}</p>
                        @endif
                    </div>
                </a>
                @endforeach

                <a href="{{ route('kegiatan.index') }}"
                    class="fade-up flex items-center justify-between p-5 rounded-2xl border-2 border-dashed border-emerald-200 hover:border-emerald-400 hover:bg-emerald-50 transition-all group">
                    <span class="text-sm font-semibold text-emerald-700">Lihat semua kegiatan</span>
                    <svg class="w-5 h-5 text-emerald-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @else
        <div class="text-center py-20 border-2 border-dashed border-stone-200 rounded-3xl">
            <p class="text-stone-400 text-sm">Belum ada kegiatan.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═══ PENGUMUMAN + KALENDER ═══ --}}
<section class="py-24" style="background:#f5f5f4;">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-5 gap-12">

            {{-- Kiri: Pengumuman --}}
            <div class="lg:col-span-3">
                <span class="section-label mb-4 block">Info & Berita</span>
                <div class="flex items-end justify-between mb-8">
                    <h2 class="font-extrabold text-stone-900 leading-tight" style="font-size:clamp(1.6rem,3vw,2.2rem);">Pengumuman</h2>
                    <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-700 hover:text-emerald-900 transition-colors group">
                        Semua
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="space-y-3">
                    @if(isset($pengumuman) && $pengumuman->count())
                        @foreach($pengumuman as $i => $item)
                        <a href="{{ route('pengumuman.show', $item->id) }}" class="announcement-row fade-up">
                            <span class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm"
                                style="background:#f0fdf4;color:#15803d;min-width:40px;">
                                {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-stone-400 mb-0.5">{{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}</p>
                                <h3 class="font-bold text-stone-900 text-sm leading-snug line-clamp-1">{{ $item->judul }}</h3>
                                <p class="text-stone-500 text-xs mt-0.5 line-clamp-1">{{ Str::limit(strip_tags($item->isi), 80) }}</p>
                            </div>
                            <svg class="w-4 h-4 text-stone-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        @endforeach
                    @else
                        <div class="py-12 text-center rounded-2xl border border-dashed border-stone-200">
                            <p class="text-stone-400 text-sm">Belum ada pengumuman.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kanan: Kalender --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-stone-100 overflow-hidden shadow-sm" x-data="kalender()">

                    {{-- Header kalender --}}
                    <div class="p-5" style="background:linear-gradient(135deg,#064e3b,#065f46);">
                        <div class="flex items-center justify-between mb-3">
                            <button @click="prevMonth()" class="w-8 h-8 rounded-xl flex items-center justify-center text-white/60 hover:text-white hover:bg-white/15 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <div class="text-center">
                                <p class="text-white font-bold text-base" x-text="monthYearLabel"></p>
                                <p class="text-amber-300 text-xs mt-0.5 font-arabic" x-text="hijriLabel"></p>
                            </div>
                            <button @click="nextMonth()" class="w-8 h-8 rounded-xl flex items-center justify-center text-white/60 hover:text-white hover:bg-white/15 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Grid hari --}}
                    <div class="p-4">
                        {{-- Label hari --}}
                        <div class="grid grid-cols-7 mb-2">
                            <template x-for="d in ['Min','Sen','Sel','Rab','Kam','Jum','Sab']" :key="d">
                                <div class="text-center text-[10px] font-bold text-stone-400 uppercase py-1" x-text="d"></div>
                            </template>
                        </div>
                        {{-- Tanggal --}}
                        <div class="grid grid-cols-7 gap-0.5">
                            {{-- Empty cells awal --}}
                            <template x-for="n in startDay" :key="'e'+n">
                                <div></div>
                            </template>
                            {{-- Hari --}}
                            <template x-for="day in daysInMonth" :key="day">
                                <button
                                    @click="selectDay(day)"
                                    class="relative aspect-square flex items-center justify-center text-xs rounded-xl transition-all font-medium"
                                    :class="{
                                        'text-white font-bold': isToday(day),
                                        'text-emerald-700 bg-emerald-50': isSelected(day) && !isToday(day),
                                        'text-stone-700 hover:bg-stone-100': !isToday(day) && !isSelected(day),
                                    }"
                                    :style="isToday(day) ? 'background:linear-gradient(135deg,#064e3b,#10b981);' : ''">
                                    <span x-text="day"></span>
                                    {{-- Dot jika ada kegiatan --}}
                                    <template x-if="hasEvent(day)">
                                        <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-amber-400"></span>
                                    </template>
                                </button>
                            </template>
                        </div>

                        {{-- Info tanggal dipilih --}}
                        <div class="mt-4 pt-4 border-t border-stone-100">
                            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-1">Dipilih</p>
                            <p class="text-stone-800 font-bold text-sm" x-text="selectedMasehi"></p>
                            <p class="text-amber-600 text-xs font-arabic mt-0.5" x-text="selectedHijri"></p>
                        </div>

                        {{-- Agenda bulan ini --}}
                        @if($kegiatanTerdekat)
                        <div class="mt-3 pt-3 border-t border-stone-100">
                            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-2">Agenda Terdekat</p>
                            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:10px 12px;">
                                <p class="text-emerald-800 font-bold text-xs leading-tight">{{ $kegiatanTerdekat->judul }}</p>
                                <p class="text-emerald-600 text-[10px] mt-1">{{ \Carbon\Carbon::parse($kegiatanTerdekat->tanggal)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ DONASI & INFAQ ═══ --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <span class="section-label mb-3 block">Transparansi & Kepercayaan</span>
                <h2 class="font-extrabold text-stone-900 leading-tight" style="font-size:clamp(1.8rem,3vw,2.5rem);">
                    Infaq & Donasi
                </h2>
                <p class="text-stone-500 text-sm mt-2 max-w-md">Program donasi yang sedang berjalan. Semua transparan dan dapat dipantau publik.</p>
            </div>
            <a href="{{ route('donasi.landing') }}"
                class="self-start inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-900 transition-colors group">
                Donasi sekarang
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- Total banner --}}
        <div class="fade-up rounded-3xl p-8 mb-8 relative overflow-hidden"
            style="background:linear-gradient(135deg,#022c22 0%,#064e3b 60%,#065f46 100%);">
            <div class="pattern-bg absolute inset-0 opacity-20"></div>
            <div class="relative grid md:grid-cols-3 gap-8">
                <div class="text-center md:text-left">
                    <p class="text-white/50 text-xs uppercase tracking-widest font-semibold mb-2">Total Terkumpul</p>
                    <p class="text-white font-extrabold" style="font-size:clamp(1.6rem,3vw,2.5rem);">
                        Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-white/50 text-xs uppercase tracking-widest font-semibold mb-2">Total Target</p>
                    <p class="text-amber-300 font-extrabold" style="font-size:clamp(1.6rem,3vw,2.5rem);">
                        Rp {{ number_format($totalTarget ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="text-center md:text-right flex flex-col justify-center">
                    @php $persen = ($totalTarget ?? 0) > 0 ? min(100, round(($totalDonasi / $totalTarget) * 100)) : 0; @endphp
                    <p class="text-white/50 text-xs uppercase tracking-widest font-semibold mb-2">Tercapai</p>
                    <p class="text-emerald-300 font-extrabold text-4xl">{{ $persen }}%</p>
                </div>
            </div>
            {{-- Overall progress bar --}}
            <div class="relative mt-6">
                <div class="h-2 rounded-full" style="background:rgba(255,255,255,0.1);">
                    <div class="h-full rounded-full progress-fill" data-width="{{ $persen }}"
                        style="width:0%;background:linear-gradient(90deg,#10b981,#fbbf24);transition:width 1.2s cubic-bezier(0.34,1.56,0.64,1);">
                    </div>
                </div>
                <p class="text-white/30 text-xs mt-2">{{ $persen }}% dari total target keseluruhan program</p>
            </div>
        </div>

        {{-- Program cards --}}
        @if(isset($programs) && $programs->count())
        <div class="grid md:grid-cols-2 gap-5">
            @foreach($programs as $prog)
            @php
                $p = $prog->target_dana > 0
                    ? min(100, round(($prog->dana_terkumpul / $prog->target_dana) * 100))
                    : 0;
            @endphp
            <div class="fade-up card p-6">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div class="flex-1 min-w-0">
                        <span class="badge badge-green mb-2">Aktif</span>
                        <h3 class="font-bold text-stone-900 text-base leading-snug">{{ $prog->nama_program }}</h3>
                        @if($prog->deskripsi)
                        <p class="text-stone-500 text-xs mt-1 line-clamp-2">{{ Str::limit($prog->deskripsi, 80) }}</p>
                        @endif
                    </div>
                    <div class="text-right shrink-0">
                        <p class="font-extrabold text-emerald-700 text-lg leading-none">{{ $p }}%</p>
                        <p class="text-stone-400 text-[10px] mt-0.5">tercapai</p>
                    </div>
                </div>

                {{-- Progress bar --}}
                <div class="h-2 rounded-full bg-stone-100 overflow-hidden mb-3 progress-bar-wrapper">
                    <div class="h-full rounded-full progress-fill"
                        data-width="{{ $p }}"
                        style="width:0%;background:linear-gradient(90deg,#10b981,#f59e0b);transition:width 1.2s cubic-bezier(0.34,1.56,0.64,1);">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-stone-400 text-[10px] uppercase tracking-wide">Terkumpul</p>
                        <p class="font-bold text-stone-800 text-sm">Rp {{ number_format($prog->dana_terkumpul, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-stone-400 text-[10px] uppercase tracking-wide">Target</p>
                        <p class="font-bold text-stone-500 text-sm">Rp {{ number_format($prog->target_dana, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('donasi.form', $prog->id_program) }}"
                        style="display:inline-flex;align-items:center;gap:6px;background:#064e3b;color:white;font-size:12px;font-weight:600;padding:8px 16px;border-radius:100px;transition:all 0.2s;text-decoration:none;"
                        onmouseenter="this.style.background='#065f46';this.style.transform='translateY(-1px)'"
                        onmouseleave="this.style.background='#064e3b';this.style.transform='translateY(0)'">
                        Donasi
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 border-2 border-dashed border-stone-200 rounded-3xl">
            <p class="text-stone-400 text-sm">Belum ada program donasi aktif.</p>
        </div>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('laporan.publik') }}"
                class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-stone-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Lihat laporan keuangan lengkap →
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{-- Hijri calendar library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-hijri/2.1.2/moment-hijri.min.js"></script>

<script>
// ── ALPINE: SLIDER ──
function slider() {
    return {
        current: 0,
        slides: @json($kegiatanSlider->keys()->toArray()),
        labels: @json($kegiatanSlider->pluck('judul')->toArray()),
        timer: null,
        init() { if (this.slides.length > 1) this.autoPlay(); },
        autoPlay() { this.timer = setInterval(() => this.next(), 4000); },
        next() { this.current = (this.current + 1) % this.slides.length; },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
        goTo(i) { this.current = i; clearInterval(this.timer); this.autoPlay(); }
    }
}

// ── ALPINE: KALENDER ──
function kalender() {
    return {
        today: moment(),
        viewDate: moment(),
        selected: moment(),
        // Tanggal kegiatan — inject dari PHP
        eventDates: @json($kegiatan->pluck('tanggal')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))->toArray()),

        get monthYearLabel() {
            const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            return months[this.viewDate.month()] + ' ' + this.viewDate.year();
        },
        get hijriLabel() {
            try {
                const m = moment(this.viewDate.format('YYYY-MM') + '-01', 'YYYY-MM-DD');
                return m.format('iMMMM iYYYY H');
            } catch(e) { return ''; }
        },
        get daysInMonth() {
            return this.viewDate.daysInMonth();
        },
        get startDay() {
            return moment(this.viewDate).startOf('month').day();
        },
        get selectedMasehi() {
            const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            return days[this.selected.day()] + ', ' + this.selected.date() + ' ' + months[this.selected.month()] + ' ' + this.selected.year();
        },
        get selectedHijri() {
            try {
                const hijriMonths = ['Muharram','Safar','Rabi\'ul Awal','Rabi\'ul Akhir','Jumadil Awal','Jumadil Akhir','Rajab','Sya\'ban','Ramadhan','Syawal','Dzulqa\'dah','Dzulhijjah'];
                const m = moment(this.selected.format('YYYY-MM-DD'), 'YYYY-MM-DD');
                const iDay = m.iDate();
                const iMonth = m.iMonth();
                const iYear = m.iYear();
                return iDay + ' ' + hijriMonths[iMonth] + ' ' + iYear + ' H';
            } catch(e) { return ''; }
        },
        isToday(day) {
            return this.today.date() === day &&
                   this.today.month() === this.viewDate.month() &&
                   this.today.year() === this.viewDate.year();
        },
        isSelected(day) {
            return this.selected.date() === day &&
                   this.selected.month() === this.viewDate.month() &&
                   this.selected.year() === this.viewDate.year();
        },
        hasEvent(day) {
            const dateStr = this.viewDate.year() + '-' +
                String(this.viewDate.month()+1).padStart(2,'0') + '-' +
                String(day).padStart(2,'0');
            return this.eventDates.includes(dateStr);
        },
        selectDay(day) {
            this.selected = moment(this.viewDate).date(day);
        },
        prevMonth() { this.viewDate = moment(this.viewDate).subtract(1,'month'); },
        nextMonth() { this.viewDate = moment(this.viewDate).add(1,'month'); },
    }
}

// ── HERO ANIMATE ──
document.querySelectorAll('.hero-animate').forEach((el, i) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    el.style.transitionDelay = (i * 110) + 'ms';
    setTimeout(() => { el.style.opacity='1'; el.style.transform='translateY(0)'; }, 100);
});

// ── INTERSECTION OBSERVER ──
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (!e.isIntersecting) return;
        if (e.target.classList.contains('fade-up')) e.target.classList.add('visible');
        if (e.target.classList.contains('progress-fill')) {
            setTimeout(() => { e.target.style.width = (e.target.dataset.width || 0) + '%'; }, 200);
        }
        io.unobserve(e.target);
    });
}, { threshold: 0.15 });

document.querySelectorAll('.fade-up, .progress-fill').forEach(el => io.observe(el));
</script>
@endpush