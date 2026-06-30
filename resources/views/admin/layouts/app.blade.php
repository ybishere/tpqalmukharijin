<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: window.innerWidth >= 1024, sidebarMobile: false }">
<html lang="id" 
    x-data="{ sidebarOpen: true, sidebarMobile: false }"
    x-init="sidebarOpen = window.innerWidth >= 1024">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Admin TPQ Al-Mukharijin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .font-amiri { font-family: 'Amiri', serif; }
        [x-cloak] { display: none !important; }

        .sidebar {
            background: linear-gradient(180deg, #064e3b 0%, #065f46 60%, #047857 100%);
            transition: width 0.3s ease;
        }
        .nav-item {
            transition: all 0.2s;
            border-radius: 10px;
            position: relative;
        }
        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.12);
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: #fbbf24;
            border-radius: 0 3px 3px 0;
        }
        .nav-icon { color: rgba(255,255,255,0.65); transition: color 0.2s; flex-shrink: 0; }
        .nav-item:hover .nav-icon,
        .nav-item.active .nav-icon { color: #fff; }
        .nav-label { color: rgba(255,255,255,0.8); transition: color 0.2s; white-space: nowrap; overflow: hidden; }
        .nav-item:hover .nav-label,
        .nav-item.active .nav-label { color: #fff; font-weight: 700; }

        .sidebar-scroll::-webkit-scrollbar { width: 3px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 99px; }

        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-content { animation: pageFadeIn 0.4s ease; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen" x-cloak>

    {{-- Mobile overlay --}}
    <div x-show="sidebarMobile"
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click="sidebarMobile = false"
        class="fixed inset-0 bg-black/50 z-20 lg:hidden">
    </div>

    <div class="flex h-screen overflow-hidden">

        {{-- ===== SIDEBAR ===== --}}
        <aside
            :class="sidebarMobile ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            :style="sidebarOpen ? 'width:260px' : 'width:100px'"
            class="sidebar fixed lg:relative z-30 h-full flex flex-col transition-transform duration-300 lg:transition-none"
            style="width:260px">

            {{-- Logo --}}
            <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div x-show="sidebarOpen"
                    x-transition:enter="transition-opacity duration-200 delay-100"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <p class="font-amiri text-white font-bold text-base leading-tight">Al-Mukharijin</p>
                    <p class="text-emerald-300 text-[10px] tracking-widest uppercase">Admin Panel</p>
                </div>
                <button @click="sidebarOpen = !sidebarOpen"
                    class="ml-auto text-white/50 hover:text-white transition-colors hidden lg:block">
                    <svg class="w-4 h-4" :class="sidebarOpen ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-4 overflow-y-auto sidebar-scroll space-y-1">

                <p x-show="sidebarOpen" class="text-[10px] font-bold tracking-widest uppercase text-emerald-400/70 px-2 mb-2">Utama</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="nav-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span x-show="sidebarOpen" class="nav-label text-sm">Dashboard</span>
                </a>

                <div x-show="sidebarOpen" class="pt-3">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-emerald-400/70 px-2 mb-2">Program & Donasi</p>
                </div>

                <a href="{{ route('admin.program.index') }}"
                    class="nav-item flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.program*') ? 'active' : '' }}">
                    <svg class="nav-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span x-show="sidebarOpen" class="nav-label text-sm">Program</span>
                </a>

                <a href="{{ route('admin.donasi.index') }}"
                    class="nav-item flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.donasi*') ? 'active' : '' }}">
                    <svg class="nav-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span x-show="sidebarOpen" class="nav-label text-sm">Donasi</span>
                </a>

                <a href="{{ route('admin.penggunaan.index') }}"
                    class="nav-item flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.penggunaan*') ? 'active' : '' }}">
                    <svg class="nav-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span x-show="sidebarOpen" class="nav-label text-sm">Penggunaan Dana</span>
                </a>

                <div x-show="sidebarOpen" class="pt-3">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-emerald-400/70 px-2 mb-2">Laporan</p>
                </div>

                <a href="{{ route('admin.laporan.index') }}"
                    class="nav-item flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                    <svg class="nav-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span x-show="sidebarOpen" class="nav-label text-sm">Laporan</span>
                </a>

            </nav>

            {{-- User info --}}
            <div class="border-t border-white/10 px-3 py-3">
                <div class="flex items-center gap-3 px-2 py-2 rounded-xl hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-400/20 border border-emerald-400/30 flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xs">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <div x-show="sidebarOpen" class="min-w-0">
                        <p class="text-white text-xs font-semibold truncate">{{ Auth::guard('admin')->user()->name }}</p>
                        <p class="text-emerald-400 text-[10px] capitalize">{{ Auth::guard('admin')->user()->role }}</p>
                    </div>
                </div>
            </div>

        </aside>
        {{-- ===== END SIDEBAR ===== --}}

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- ===== TOPBAR ===== --}}
            <header class="bg-white border-b border-gray-100 flex items-center gap-4 px-6 py-3.5 z-10">

                <button @click="sidebarMobile = !sidebarMobile" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex-1 min-w-0">
                    <h2 class="text-gray-800 font-bold text-sm lg:text-base truncate">@yield('page_title', 'Dashboard')</h2>
                    @hasSection('breadcrumb')
                        <div class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">@yield('breadcrumb')</div>
                    @endif
                </div>

                <div class="flex items-center gap-3">

                    {{-- Notifikasi --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="relative w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 top-full mt-2 w-72 bg-white rounded-xl shadow-xl border border-gray-100 z-50">
                            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                                <p class="text-sm font-bold text-gray-800">Notifikasi</p>
                                <span class="text-[10px] text-emerald-600 font-semibold bg-emerald-50 px-2 py-0.5 rounded-full">Baru</span>
                            </div>
                            <div class="px-4 py-6 text-center text-sm text-gray-400">
                                Tidak ada notifikasi baru
                            </div>
                        </div>
                    </div>

                    {{-- Profile --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2.5 rounded-xl px-2.5 py-1.5 hover:bg-gray-100 transition-all">
                            <div class="w-8 h-8 rounded-lg bg-emerald-700 flex items-center justify-center">
                                <span class="text-white font-bold text-xs">
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-xs font-bold text-gray-800 leading-tight">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-[10px] text-gray-400 capitalize">{{ Auth::guard('admin')->user()->role }}</p>
                            </div>
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 top-full mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50">
                            <div class="px-4 py-3 bg-emerald-50 border-b border-gray-100">
                                <p class="text-xs font-bold text-emerald-800">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-[10px] text-emerald-600 truncate">{{ Auth::guard('admin')->user()->email }}</p>
                            </div>
                            <div class="py-1 border-t border-gray-100">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </header>
            {{-- ===== END TOPBAR ===== --}}

            {{-- ===== CONTENT ===== --}}
            <main class="flex-1 overflow-y-auto p-6 page-content">

                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3 text-sm text-emerald-700">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                        <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-600">✕</button>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show"
                        class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3 text-sm text-red-700">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                        <button @click="show = false" class="ml-auto text-red-400 hover:text-red-600">✕</button>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>