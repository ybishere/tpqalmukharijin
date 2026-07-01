<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TPQ Al-Mukharijin')</title>
    <meta name="description" content="@yield('meta_description', 'TPQ Al-Mukharijin Desa Kreman - Tempat Pendidikan Al-Quran untuk generasi Islam yang berakhlak mulia.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --emerald:      #064e3b;
            --emerald-mid:  #065f46;
            --emerald-soft: #10b981;
            --gold:         #b45309;
            --gold-light:   #d97706;
            --gold-pale:    #fef3c7;
            --cream:        #fdfdf8;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--cream); color: #1c1c1e; }
        .font-amiri { font-family: 'Amiri', serif; }

        .ornament-divider { display: flex; align-items: center; gap: 12px; color: var(--gold-light); }
        .ornament-divider::before, .ornament-divider::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, transparent, #d97706, transparent);
        }

        .navbar-scrolled {
            background: rgba(6, 78, 59, 0.97) !important;
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 24px rgba(0,0,0,0.15);
        }

        .btn-gold {
            background: linear-gradient(135deg, #d97706, #b45309);
            position: relative; overflow: hidden; transition: all 0.3s;
        }
        .btn-gold::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.4s;
        }
        .btn-gold:hover::before { left: 100%; }
        .btn-gold:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(217,119,6,0.4); }

        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M30 0l7.5 13H22.5L30 0zm0 60L22.5 47h15L30 60zM0 30l13-7.5V37.5L0 30zm60 0L47 37.5V22.5L60 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .fade-up { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(6,78,59,0.12); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 99px; }

        /* Dropdown menu */
        .nav-dropdown { position: relative; }
        .nav-dropdown-menu {
            position: absolute; top: calc(100% + 12px); left: 50%;
            transform: translateX(-50%);
            background: white; border-radius: 12px; min-width: 180px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            border: 1px solid rgba(0,0,0,0.06);
            opacity: 0; visibility: hidden; transition: all 0.2s ease;
            transform: translateX(-50%) translateY(-8px);
        }
        .nav-dropdown:hover .nav-dropdown-menu {
            opacity: 1; visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        .nav-dropdown-menu a {
            display: block; padding: 10px 16px;
            font-size: 13px; color: #1c1c1e;
            transition: background 0.15s;
            border-radius: 8px;
        }
        .nav-dropdown-menu a:hover { background: #f0fdf4; color: #064e3b; }
    </style>
    @stack('styles')
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav id="navbar"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    x-data="{ open: false, scrolled: false, mobileSubmenu: '' }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'navbar-scrolled' : 'bg-emerald-900/80 backdrop-blur-sm'">

    <div class="max-w-6xl mx-auto px-5 py-3.5 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('beranda') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/20 border border-white/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <p class="font-amiri text-white font-bold text-base leading-tight">TPQ Al-Mukharijin</p>
                <p class="text-white/60 text-[10px] tracking-widest uppercase">Desa Kreman</p>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-6">
            <a href="{{ route('beranda') }}"
                class="text-sm font-medium transition-colors {{ request()->routeIs('beranda') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                Beranda
            </a>

            {{-- Dropdown: Tentang --}}
            <div class="nav-dropdown">
                <button class="text-sm font-medium transition-colors flex items-center gap-1
                    {{ request()->routeIs('profil.*', 'memoriam.*', 'pengasuh.*') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                    Tentang
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="nav-dropdown-menu p-1.5">
                    <a href="{{ route('profil.index') }}">Profil TPQ</a>
                    <a href="{{ route('profil.memoriam') }}">In Memoriam</a>
                    <a href="{{ route('profil.pengasuh') }}">Pengasuh & Pengajar</a>
                </div>
            </div>

            <a href="{{ route('kegiatan.index') }}"
                class="text-sm font-medium transition-colors {{ request()->routeIs('kegiatan.*') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                Kegiatan
            </a>

            <a href="{{ route('pengumuman.index') }}"
                class="text-sm font-medium transition-colors {{ request()->routeIs('pengumuman.*') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                Pengumuman
            </a>

            <a href="{{ route('alumni.index') }}"
                class="text-sm font-medium transition-colors {{ request()->routeIs('alumni.*') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                Alumni
            </a>

            <a href="{{ route('donasi.landing') }}"
                class="btn-gold text-white text-sm font-semibold px-5 py-2.5 rounded-full inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Donasi
            </a>
        </div>

        {{-- Mobile Toggle --}}
        <button @click="open = !open" class="lg:hidden text-white p-1">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition
        class="lg:hidden bg-emerald-900/97 backdrop-blur-lg border-t border-white/10 px-5 py-4 space-y-1">

        <a href="{{ route('beranda') }}" @click="open=false"
            class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
            Beranda
        </a>

        {{-- Mobile submenu: Tentang --}}
        <div>
            <button @click="mobileSubmenu = mobileSubmenu === 'tentang' ? '' : 'tentang'"
                class="w-full flex items-center justify-between py-3 text-sm font-medium text-white/80 border-b border-white/10">
                Tentang
                <svg class="w-4 h-4 transition-transform" :class="mobileSubmenu === 'tentang' ? 'rotate-180' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="mobileSubmenu === 'tentang'" x-transition class="pl-4 py-1 space-y-1">
                <a href="{{ route('profil.index') }}" @click="open=false"
                    class="block py-2 text-sm text-white/60 hover:text-amber-300 transition-colors">Profil TPQ</a>
                <a href="{{ route('profil.memoriam') }}" @click="open=false"
                    class="block py-2 text-sm text-white/60 hover:text-amber-300 transition-colors">In Memoriam</a>
                <a href="{{ route('profil.pengasuh') }}" @click="open=false"
                    class="block py-2 text-sm text-white/60 hover:text-amber-300 transition-colors">Pengasuh & Pengajar</a>
            </div>
        </div>

        <a href="{{ route('kegiatan.index') }}" @click="open=false"
            class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
            Kegiatan
        </a>
        <a href="{{ route('pengumuman.index') }}" @click="open=false"
            class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
            Pengumuman
        </a>
        <a href="{{ route('alumni.index') }}" @click="open=false"
            class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
            Alumni
        </a>
        <a href="{{ route('donasi.landing') }}" @click="open=false"
            class="block mt-3 text-center btn-gold text-white font-semibold py-3 rounded-xl text-sm">
            Donasi Sekarang
        </a>
    </div>
</nav>
{{-- ===== END NAVBAR ===== --}}

<main>
    @yield('content')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="bg-emerald-950 text-white relative overflow-hidden">
    <div class="islamic-pattern absolute inset-0"></div>
    <div class="h-0.5 bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>

    <div class="relative max-w-6xl mx-auto px-5 py-14">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 mb-10">

            {{-- Brand --}}
            <div class="md:col-span-4">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-amiri text-lg font-bold text-white">TPQ Al-Mukharijin</p>
                        <p class="text-emerald-400 text-xs tracking-widest uppercase">Desa Kreman</p>
                    </div>
                </div>
                <p class="text-white/50 text-sm leading-relaxed mb-4">
                    Mendidik generasi Qurani yang berakhlak mulia, cerdas, dan bermanfaat bagi agama, keluarga, dan masyarakat.
                </p>
                <p class="font-amiri text-amber-300 text-xl">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
            </div>

            {{-- Nav Links --}}
            <div class="md:col-span-2 md:col-start-6">
                <p class="text-white font-semibold text-sm mb-4">Tentang</p>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('profil.index') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Profil TPQ</a></li>
                    <li><a href="{{ route('profil.memoriam') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">In Memoriam</a></li>
                    <li><a href="{{ route('profil.pengasuh') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Pengasuh & Pengajar</a></li>
                    <li><a href="{{ route('alumni.index') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Alumni</a></li>
                </ul>
            </div>

            <div class="md:col-span-2">
                <p class="text-white font-semibold text-sm mb-4">Informasi</p>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('kegiatan.index') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Kegiatan</a></li>
                    <li><a href="{{ route('pengumuman.index') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Pengumuman</a></li>
                    <li><a href="{{ route('donasi.landing') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Donasi</a></li>
                    <li><a href="{{ route('laporan.publik') }}" class="text-white/50 text-sm hover:text-amber-300 transition-colors">Laporan Keuangan</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="md:col-span-2">
                <p class="text-white font-semibold text-sm mb-4">Kontak</p>
                <ul class="space-y-2.5">
                    <li class="flex items-start gap-2 text-white/50 text-sm">
                        <svg class="w-4 h-4 mt-0.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Desa Kreman, Jawa Tengah
                    </li>
                </ul>
                {{-- Social media --}}
                <div class="flex gap-3 mt-5">
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom --}}
        <div class="border-t border-white/10 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-white/30 text-xs">© {{ date('Y') }} TPQ Al-Mukharijin. Semua hak dilindungi.</p>
            <p class="text-white/30 text-xs">Dibuat dengan ❤️ untuk para santri</p>
        </div>
    </div>
</footer>
{{-- ===== END FOOTER ===== --}}

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

@stack('scripts')
</body>
</html>