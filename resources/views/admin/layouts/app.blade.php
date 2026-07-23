<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — TPQ Al-Mukharijin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f2; }
        .font-amiri { font-family: 'Amiri', serif; }
        [x-cloak] { display: none !important; }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #022c22 0%, #064e3b 60%, #065f46 100%);
            background-image:
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.025'%3E%3Cpath d='M30 0l7.5 13H22.5L30 0zm0 60L22.5 47h15L30 60zM0 30l13-7.5V37.5L0 30zm60 0L47 37.5V22.5L60 30z'/%3E%3C/g%3E%3C/svg%3E"),
                linear-gradient(180deg, #022c22 0%, #064e3b 60%, #065f46 100%);
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 40;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
        }

        .sidebar-nav { overflow-y: auto; flex: 1; }
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 99px; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            transition: all 0.18s;
            text-decoration: none;
            margin-bottom: 1px;
            position: relative;
        }
        .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.9); }
        .nav-item.active {
            background: rgba(255,255,255,0.11);
            color: #fff;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 25%; bottom: 25%;
            width: 3px;
            background: #f59e0b;
            border-radius: 0 3px 3px 0;
        }
        .nav-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            background: rgba(255,255,255,0.06);
            transition: background 0.18s;
        }
        .nav-item:hover .nav-icon { background: rgba(255,255,255,0.1); }
        .nav-item.active .nav-icon { background: rgba(245,158,11,0.18); }

        .nav-section {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.22);
            padding: 14px 12px 5px;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            height: 58px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 16px;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 38;
        }

        @media (max-width: 1023px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-anim { animation: fadeUp 0.35s ease; }
    </style>
    @stack('styles')
</head>
<body>
<div x-data="{ mobileOpen: false }">

    {{-- Overlay mobile --}}
    <div x-show="mobileOpen"
        x-cloak
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="sidebar-overlay lg:hidden">
    </div>

    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="sidebar" :class="mobileOpen ? 'mobile-open' : ''">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10 flex-shrink-0">
            <div class="w-9 h-9 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="font-amiri text-white font-bold text-[14px] leading-tight">TPQ Al-Mukharijin</p>
                <p class="text-white/30 text-[9px] tracking-[0.2em] uppercase mt-0.5">Panel Administrasi</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="sidebar-nav p-3">

            <p class="nav-section">Utama</p>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </span>
                Dashboard
            </a>

            <p class="nav-section">Konten TPQ</p>

            <a href="{{ route('admin.program.index') }}"
                class="nav-item {{ request()->routeIs('admin.program.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </span>
                Program Donasi
            </a>

            <a href="{{ route('admin.profil.edit') }}"
                class="nav-item {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
                </span>
    Profil TPQ
            </a>

            <a href="{{ route('admin.memoriam.index') }}"
                class="nav-item {{ request()->routeIs('admin.memoriam.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
                </span>
    In Memoriam
            </a>

           <a href="{{ route('admin.pengasuh.index') }}"
                class="nav-item {{ request()->routeIs('admin.pengasuh.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
                </span>
    Pengasuh & Pengajar
            </a>

            <a href="{{ route('admin.kegiatan.index') }}"
                class="nav-item {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
                </span>
    Kegiatan
            </a>

            <a href="{{ route('admin.kalender.index') }}"
                class="nav-item {{ request()->routeIs('admin.kalender.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
                </span>
    Kalender Akademik
            </a>

            <a href="{{ route('admin.pengumuman.index') }}"
                class="nav-item {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </span>
                Pengumuman
            </a>

            <a href="{{ route('admin.santri.index') }}"
                class="nav-item {{ request()->routeIs('admin.santri.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
                </span>
    Santri
            </a>

            <a href="{{ route('admin.prestasi.index') }}"
                class="nav-item {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
        </svg>
                </span>
    Prestasi Santri
            </a>

            <a href="{{ route('admin.admin.alumni.index') }}"
                class="nav-item {{ request()->routeIs('admin.admin.alumni.*') ? 'active' : '' }}">
                <span class="nav-icon">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
                </span>
    Alumni
            </a>

            <p class="nav-section">Keuangan</p>

            <a href="{{ route('admin.donasi.index') }}"
                class="nav-item {{ request()->routeIs('admin.donasi.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </span>
                Donasi Masuk
            </a>

            <a href="{{ route('admin.penggunaan.index') }}"
                class="nav-item {{ request()->routeIs('admin.penggunaan.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </span>
                Penggunaan Dana
            </a>

            <a href="{{ route('admin.laporan.index') }}"
                class="nav-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
                Laporan Keuangan
            </a>

        </nav>

        {{-- Admin info bottom --}}
        <div class="flex-shrink-0 p-3 border-t border-white/8">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-white/5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 border border-amber-500/25 flex items-center justify-center flex-shrink-0">
                    <span class="text-amber-300 font-bold text-xs">
                        {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 2)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-xs font-semibold truncate">{{ auth('admin')->user()->name ?? 'Admin' }}</p>
                    <p class="text-white/30 text-[10px]">Administrator</p>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" title="Logout"
                        class="w-7 h-7 rounded-lg bg-white/5 hover:bg-red-500/20 flex items-center justify-center transition-colors group">
                        <svg class="w-3.5 h-3.5 text-white/30 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ═══ MAIN ═══ --}}
    <div class="main-content">

        {{-- Topbar --}}
        <header class="topbar">

            {{-- Mobile hamburger --}}
            <button @click="mobileOpen = !mobileOpen"
                class="lg:hidden w-8 h-8 rounded-lg bg-stone-100 hover:bg-stone-200 flex items-center justify-center text-stone-500 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-1.5 text-xs text-stone-400 flex-1 min-w-0">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors font-semibold text-stone-500 flex-shrink-0">
                    Admin
                </a>
                @hasSection('breadcrumb')
                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                @yield('breadcrumb')
                @endif
            </div>

            {{-- Page title center --}}
            <h1 class="font-bold text-stone-800 text-sm hidden md:block flex-shrink-0">
                @yield('page_title', 'Dashboard')
            </h1>

            {{-- Right actions --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('beranda') }}" target="_blank"
                    class="hidden sm:flex items-center gap-1.5 text-xs text-stone-400 hover:text-emerald-600 transition-colors px-3 py-1.5 rounded-lg hover:bg-emerald-50">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat Website
                </a>

                {{-- Avatar dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-8 h-8 rounded-lg bg-emerald-700 flex items-center justify-center hover:bg-emerald-800 transition-colors">
                        <span class="text-white font-bold text-xs">
                            {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 2)) }}
                        </span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-cloak
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-stone-100 overflow-hidden z-50">
                        <div class="px-4 py-3 bg-emerald-50 border-b border-stone-100">
                            <p class="text-xs font-bold text-emerald-800 truncate">{{ auth('admin')->user()->name ?? 'Admin' }}</p>
                            <p class="text-[10px] text-emerald-600 truncate">{{ auth('admin')->user()->email ?? '' }}</p>
                        </div>
                        <div class="p-1">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-2.5 px-3 py-2 text-xs text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        {{-- Content --}}
        <main class="flex-1 p-5 lg:p-6 page-anim">

            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-cloak
                x-init="setTimeout(() => show = false, 4000)"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm">
                <svg class="w-4 h-4 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
                <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-cloak
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                <svg class="w-4 h-4 flex-shrink-0 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
                <button @click="show = false" class="ml-auto text-red-400 hover:text-red-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endif

            @yield('content')

        </main>

        <footer class="px-6 py-3 border-t border-stone-100">
            <p class="text-[11px] text-stone-300 text-center">© {{ date('Y') }} TPQ Al-Mukharijin — Panel Administrasi</p>
        </footer>

    </div>

</div>
@stack('scripts')
</body>
</html>


