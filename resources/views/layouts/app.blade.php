<!DOCTYPE html>
<html lang="id" class="grain">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- ═══ SEO META TAGS ═══ --}}
    <title>@yield('title', 'TPQ Al-Mukharijin – Desa Kreman, Tegal')</title>
    <meta name="description" content="@yield('meta_description', 'TPQ Al-Mukharijin Desa Kreman, Kecamatan Warureja, Kabupaten Tegal — Mendidik generasi Qurani yang berakhlak mulia sejak 1991.')">
    <meta name="keywords" content="@yield('meta_keywords', 'TPQ Al-Mukharijin, TPQ Desa Kreman, TPQ Warureja, TPQ Tegal, belajar Al-Quran Tegal, pendidikan Al-Quran')">
    <meta name="author" content="TPQ Al-Mukharijin">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="TPQ Al-Mukharijin">
    <meta property="og:title" content="@yield('og_title', 'TPQ Al-Mukharijin – Desa Kreman, Tegal')">
    <meta property="og:description" content="@yield('og_description', 'TPQ Al-Mukharijin Desa Kreman — Mendidik generasi Qurani yang berakhlak mulia sejak 1991.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/gedung-tpq.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'TPQ Al-Mukharijin – Desa Kreman, Tegal')">
    <meta name="twitter:description" content="@yield('og_description', 'TPQ Al-Mukharijin Desa Kreman — Mendidik generasi Qurani yang berakhlak mulia sejak 1991.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/gedung-tpq.jpg'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    {{-- ═══ END SEO ═══ --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-[#fafaf9]">

{{-- ═══════════════ NAVBAR ═══════════════ --}}
<header
    x-data="{ open: false, scrolled: false, submenu: '' }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 40)"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500"
    :class="scrolled ? 'navbar-blur py-3' : 'bg-transparent py-5'">

    <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
            <div class="w-9 h-9 rounded-2xl overflow-hidden bg-white/15 border border-white/25 flex items-center justify-center group-hover:bg-white/25 transition-colors">
                <img src="{{ asset('images/logo.png') }}" alt="Logo TPQ Al-Mukharijin" class="w-full h-full object-contain p-0.5">
            </div>
            <div class="leading-tight">
                <p class="font-arabic text-white font-bold text-[15px]">TPQ Al-Mukharijin</p>
                <p class="text-white/45 text-[9px] tracking-[0.2em] uppercase">Desa Kreman</p>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden lg:flex items-center gap-1">
            <a href="{{ route('beranda') }}"
                class="px-4 py-2 rounded-xl text-[13px] font-medium transition-all
                {{ request()->routeIs('beranda') ? 'text-amber-300 bg-white/10' : 'text-white/75 hover:text-white hover:bg-white/8' }}">
                Beranda
            </a>

            {{-- Dropdown Tentang --}}
            <div class="relative" x-data="{ open: false }"
                @mouseenter="open = true" @mouseleave="open = false">
                <button class="px-4 py-2 rounded-xl text-[13px] font-medium transition-all flex items-center gap-1.5
                    {{ request()->routeIs('profil.*') ? 'text-amber-300 bg-white/10' : 'text-white/75 hover:text-white hover:bg-white/8' }}">
                    Tentang
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="absolute top-full left-0 pt-2 w-52" style="display:none">
                    <div class="bg-white rounded-2xl shadow-xl border border-black/5 p-1.5 overflow-hidden">
                        <a href="{{ route('profil.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] text-stone-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors font-medium">
                            <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/></svg>
                            </span>
                            Profil TPQ
                        </a>
                        <a href="{{ route('profil.memoriam') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] text-stone-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors font-medium">
                            <span class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </span>
                            In Memoriam
                        </a>
                        <a href="{{ route('profil.pengasuh') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] text-stone-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors font-medium">
                            <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            Pengasuh & Pengajar
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('kegiatan.index') }}"
                class="px-4 py-2 rounded-xl text-[13px] font-medium transition-all
                {{ request()->routeIs('kegiatan.*') ? 'text-amber-300 bg-white/10' : 'text-white/75 hover:text-white hover:bg-white/8' }}">
                Kegiatan
            </a>
            <a href="{{ route('pengumuman.index') }}"
                class="px-4 py-2 rounded-xl text-[13px] font-medium transition-all
                {{ request()->routeIs('pengumuman.*') ? 'text-amber-300 bg-white/10' : 'text-white/75 hover:text-white hover:bg-white/8' }}">
                Pengumuman
            </a>
            <a href="{{ route('alumni.index') }}"
                class="px-4 py-2 rounded-xl text-[13px] font-medium transition-all
                {{ request()->routeIs('alumni.*') ? 'text-amber-300 bg-white/10' : 'text-white/75 hover:text-white hover:bg-white/8' }}">
                Alumni
            </a>

            {{-- Dropdown Infaq & Donasi --}}
    <div class="relative" x-data="{ open: false }"
        @mouseenter="open = true" @mouseleave="open = false">
        <button class="px-4 py-2 rounded-xl text-[13px] font-medium transition-all flex items-center gap-1.5
            {{ request()->routeIs('donasi.*') || request()->routeIs('infaq.*') ? 'text-amber-300 bg-white/10' : 'text-white/75 hover:text-white hover:bg-white/8' }}">
            Infaq & Donasi
            <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    <div x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute top-full left-0 pt-2 w-52" style="display:none">
        <div class="bg-white rounded-2xl shadow-xl border border-black/5 p-1.5 overflow-hidden">
            <a href="{{ route('donasi.landing') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] text-stone-700 hover:bg-emerald-50 hover:text-emerald-800 transition-colors font-medium">
                <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                Donasi Program
            </a>
            <a href="{{ route('infaq.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] text-stone-700 hover:bg-amber-50 hover:text-amber-800 transition-colors font-medium">
                <span class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                Infaq Kamisan
            </a>
        </div>
    </div>
</div>
        </nav>

        {{-- Mobile toggle --}}
        <button @click="open = !open" class="lg:hidden w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="lg:hidden mx-4 mt-2 bg-[#022c22]/95 backdrop-blur-xl rounded-2xl border border-white/10 p-4 space-y-1"
        style="display:none">
        <a href="{{ route('beranda') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Beranda</a>
        <a href="{{ route('profil.index') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Profil TPQ</a>
        <a href="{{ route('profil.memoriam') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">In Memoriam</a>
        <a href="{{ route('profil.pengasuh') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Pengasuh & Pengajar</a>
        <a href="{{ route('kegiatan.index') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Kegiatan</a>
        <a href="{{ route('pengumuman.index') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Pengumuman</a>
        <a href="{{ route('alumni.index') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Alumni</a>
        <div class="pt-1 border-t border-white/10">
            <a href="{{ route('donasi.landing') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Donasi Program</a>
            <a href="{{ route('infaq.index') }}" @click="open=false" class="block px-4 py-3 rounded-xl text-sm text-white/80 hover:text-white hover:bg-white/8 transition-all font-medium">Infaq Kamisan</a>
        </div>
    </div>
</header>
{{-- ═══════════════ END NAVBAR ═══════════════ --}}

<main>@yield('content')</main>

{{-- ═══════════════ FOOTER ═══════════════ --}}
<footer class="bg-[#0a1a12] text-white relative overflow-hidden">
    <div class="pattern-bg absolute inset-0"></div>
    <div class="h-px bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-16">
        <div class="grid grid-cols-2 lg:grid-cols-12 gap-8 pb-12 border-b border-white/8">

            {{-- Brand --}}
            <div class="col-span-2 lg:col-span-4">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-2xl overflow-hidden bg-white/10 border border-white/15 flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo TPQ Al-Mukharijin" class="w-full h-full object-contain p-0.5">
                    </div>
                    <div>
                        <p class="font-arabic text-white font-bold text-base">TPQ Al-Mukharijin</p>
                        <p class="text-white/35 text-[10px] tracking-[0.2em] uppercase">Desa Kreman</p>
                    </div>
                </div>
                <p class="text-white/40 text-sm leading-relaxed mb-6 max-w-xs">
                    Mendidik generasi Qurani yang berakhlak mulia, cerdas, dan bermanfaat bagi agama, keluarga, dan masyarakat.
                </p>
                <p class="font-arabic text-amber-400 text-2xl leading-relaxed">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>

                {{-- Sosmed --}}
                <div class="flex gap-2 mt-6">
                    @if($profil?->facebook)
                    <a href="https://facebook.com/{{ $profil->facebook }}" target="_blank" aria-label="Facebook"
                        class="w-8 h-8 rounded-xl bg-white/8 hover:bg-white/16 border border-white/8 flex items-center justify-center transition-all hover:scale-110">
                        <svg class="w-3.5 h-3.5 text-white/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    @endif
                    @if($profil?->instagram)
                    <a href="https://instagram.com/{{ $profil->instagram }}" target="_blank" aria-label="Instagram"
                        class="w-8 h-8 rounded-xl bg-white/8 hover:bg-white/16 border border-white/8 flex items-center justify-center transition-all hover:scale-110">
                        <svg class="w-3.5 h-3.5 text-white/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    @endif
                    @if($profil?->youtube)
                    <a href="https://youtube.com/{{ $profil->youtube }}" target="_blank" aria-label="YouTube"
                        class="w-8 h-8 rounded-xl bg-white/8 hover:bg-white/16 border border-white/8 flex items-center justify-center transition-all hover:scale-110">
                        <svg class="w-3.5 h-3.5 text-white/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            {{-- END Brand --}}

            {{-- Tentang --}}
            <div class="lg:col-span-2">
                <p class="text-white/90 font-semibold text-sm mb-5">Tentang</p>
                <ul class="space-y-3">
                    @foreach([
                        ['Profil TPQ', 'profil.index'],
                        ['In Memoriam', 'profil.memoriam'],
                        ['Pengasuh & Pengajar', 'profil.pengasuh'],
                        ['Alumni', 'alumni.index'],
                    ] as [$label, $route])
                    <li><a href="{{ route($route) }}" class="text-white/35 text-sm hover:text-white/80 transition-colors">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Informasi --}}
            <div class="lg:col-span-2">
                <p class="text-white/90 font-semibold text-sm mb-5">Informasi</p>
                <ul class="space-y-3">
                    @foreach([
                        ['Kegiatan', 'kegiatan.index'],
                        ['Pengumuman', 'pengumuman.index'],
                        ['Infaq & Donasi', 'donasi.landing'],
                        ['Laporan Keuangan', 'laporan.publik'],
                    ] as [$label, $route])
                    <li><a href="{{ route($route) }}" class="text-white/35 text-sm hover:text-white/80 transition-colors">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="col-span-2 lg:col-span-4">
                <p class="text-white/90 font-semibold text-sm mb-5">Kontak</p>
                <ul class="space-y-3">
                    <li class="flex items-start gap-2.5 text-white/35 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $profil?->alamat ?? 'Desa Kreman, Kec. Warureja, Kab. Tegal, Jawa Tengah' }}
                    </li>
                    @if($profil?->no_telp)
                    <li>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_telp) }}"
                            target="_blank"
                            class="flex items-center gap-2.5 text-white/35 hover:text-white/70 transition-colors text-sm">
                            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            {{ $profil->no_telp }}
                        </a>
                    </li>
                    @endif
                    @if($profil?->email)
                    <li>
                        <a href="mailto:{{ $profil->email }}"
                            class="flex items-center gap-2.5 text-white/35 hover:text-white/70 transition-colors text-sm">
                            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $profil->email }}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

        </div>

        <div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-white/20 text-xs">© {{ date('Y') }} TPQ Al-Mukharijin. Semua hak dilindungi.</p>
            <p class="text-white/20 text-xs">Dibuat dengan ❤️ untuk para santri dan alumni</p>
        </div>
    </div>
</footer>
{{-- ═══════════════ END FOOTER ═══════════════ --}}

{{-- Global scripts --}}
<script>
    // Fade up observer
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); fadeObserver.unobserve(e.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));
</script>

@stack('scripts')

{{-- WhatsApp Floating Button --}}
@if($profil?->no_telp)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_telp) }}?text=Assalamualaikum, saya ingin bertanya tentang TPQ Al-Mukharijin"
    target="_blank"
    class="fixed bottom-6 right-6 z-50 flex items-center gap-3 group"
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 1500)">

    {{-- Tooltip --}}
    <div x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        class="bg-white text-stone-700 text-xs font-semibold px-3 py-2 rounded-xl shadow-lg border border-stone-100 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
        Hubungi Kami
    </div>

    {{-- Button --}}
    <div x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 scale-50"
        x-transition:enter-end="opacity-100 scale-100"
        class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-xl transition-all group-hover:scale-110 group-hover:shadow-2xl"
        style="background:linear-gradient(135deg,#25d366,#128c7e);">
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>

        {{-- Pulse ring --}}
        <span class="absolute w-14 h-14 rounded-2xl animate-ping opacity-20" style="background:#25d366;"></span>
    </div>
</a>
@endif

</body>
</html>