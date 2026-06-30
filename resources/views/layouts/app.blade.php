<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TPQ Al-Mukharijin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --emerald:     #064e3b;
            --emerald-mid: #065f46;
            --emerald-soft:#10b981;
            --gold:        #b45309;
            --gold-light:  #d97706;
            --gold-pale:   #fef3c7;
            --cream:       #fdfdf8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--cream);
            color: #1c1c1e;
        }

        .font-amiri { font-family: 'Amiri', serif; }

        /* Ornament divider */
        .ornament-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--gold-light);
        }
        .ornament-divider::before,
        .ornament-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #d97706, transparent);
        }

        /* Navbar scroll effect */
        .navbar-scrolled {
            background: rgba(6, 78, 59, 0.97) !important;
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 24px rgba(0,0,0,0.15);
        }

        /* Gold shimmer button */
        .btn-gold {
            background: linear-gradient(135deg, #d97706, #b45309);
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.4s;
        }
        .btn-gold:hover::before { left: 100%; }
        .btn-gold:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(217,119,6,0.4); }

        /* Islamic pattern overlay */
        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M30 0l7.5 13H22.5L30 0zm0 60L22.5 47h15L30 60zM0 30l13-7.5V37.5L0 30zm60 0L47 37.5V22.5L60 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Animate on scroll */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Card hover */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(6,78,59,0.12);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 99px; }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav id="navbar"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent"
        x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        :class="scrolled ? 'navbar-scrolled' : 'bg-transparent'">

        <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">

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
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('beranda') }}"
                    class="text-sm font-medium transition-colors {{ request()->routeIs('beranda') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                    Beranda
                </a>
                <a href="{{ route('program.index') }}"
                    class="text-sm font-medium transition-colors {{ request()->routeIs('program.*') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                    Program
                </a>
                <a href="{{ route('laporan.publik') }}"
                    class="text-sm font-medium transition-colors {{ request()->routeIs('laporan.*') ? 'text-amber-300' : 'text-white/80 hover:text-white' }}">
                    Laporan
                </a>
                <a href="{{ route('program.index') }}"
                    class="btn-gold text-white text-sm font-semibold px-5 py-2.5 rounded-full inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Donasi Sekarang
                </a>
            </div>

            {{-- Mobile Toggle --}}
            <button @click="open = !open" class="md:hidden text-white p-1">
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
            class="md:hidden bg-emerald-900/95 backdrop-blur-lg border-t border-white/10 px-5 py-4 space-y-1">
            <a href="{{ route('beranda') }}" @click="open=false"
                class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
                Beranda
            </a>
            <a href="{{ route('program.index') }}" @click="open=false"
                class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
                Program
            </a>
            <a href="{{ route('laporan.publik') }}" @click="open=false"
                class="block py-3 text-sm font-medium text-white/80 hover:text-amber-300 border-b border-white/10 transition-colors">
                Laporan
            </a>
            <a href="{{ route('program.index') }}" @click="open=false"
                class="block mt-3 text-center btn-gold text-white font-semibold py-3 rounded-xl text-sm">
                Donasi Sekarang
            </a>
        </div>
    </nav>
    {{-- ===== END NAVBAR ===== --}}

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-emerald-950 text-white relative overflow-hidden">
        <div class="islamic-pattern absolute inset-0"></div>

        {{-- Top border gold --}}
        <div class="h-0.5 bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>

        <div class="relative max-w-6xl mx-auto px-5 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">

                {{-- Brand --}}
                <div class="md:col-span-2">
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
                    <p class="text-white/50 text-sm leading-relaxed max-w-xs">
                        Platform donasi digital untuk mendukung kegiatan belajar mengajar santri TPQ Al-Mukharijin. Transparan, terpercaya, tepat sasaran.
                    </p>
                    <p class="font-amiri text-amber-300 text-xl mt-4">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                </div>

                {{-- Navigasi --}}
                <div>
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-4">Navigasi</p>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('beranda') }}" class="text-white/60 hover:text-amber-300 text-sm transition-colors">Beranda</a></li>
                        <li><a href="{{ route('program.index') }}" class="text-white/60 hover:text-amber-300 text-sm transition-colors">Program Donasi</a></li>
                        <li><a href="{{ route('laporan.publik') }}" class="text-white/60 hover:text-amber-300 text-sm transition-colors">Laporan Transparansi</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-white/60 hover:text-amber-300 text-sm transition-colors">Login Admin</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-4">Hubungi Kami</p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-white/60 text-sm">Desa Kreman, Jawa Tengah</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="https://wa.me/6281234567890" target="_blank"
                                class="text-white/60 hover:text-amber-300 text-sm transition-colors">+62 812-3456-7890</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom --}}
            <div class="border-t border-white/10 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="text-white/40 text-xs">© {{ date('Y') }} TPQ Al-Mukharijin · Desa Kreman · Sistem Donasi Digital</p>
                <p class="text-white/40 text-xs">Dibuat dengan ❤️ untuk para santri</p>
            </div>
        </div>
    </footer>
    {{-- ===== END FOOTER ===== --}}

    {{-- Animate on scroll script --}}
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>