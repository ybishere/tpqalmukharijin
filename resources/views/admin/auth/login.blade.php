<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin — TPQ Al-Mukharijin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .font-amiri { font-family: 'Amiri', serif; }

        .bg-pattern {
            background-color: #064e3b;
            background-image:
                radial-gradient(circle at 15% 50%, rgba(16,185,129,0.2) 0%, transparent 50%),
                radial-gradient(circle at 85% 20%, rgba(217,119,6,0.15) 0%, transparent 40%),
                url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%2310b981' fill-opacity='0.04'%3E%3Cpath d='M40 0l10 17.3H30L40 0zm0 80L30 62.7h20L40 80zM0 40l17.3-10v20L0 40zm80 0L62.7 50V30L80 40z'/%3E%3C/g%3E%3C/svg%3E");
        }

        .card-login {
            background: rgba(255,255,255,0.98);
            box-shadow: 0 25px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.1);
        }

        .ornament { display: flex; align-items: center; gap: 8px; }
        .ornament::before, .ornament::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #d97706, transparent);
        }

        .btn-login {
            background: linear-gradient(135deg, #065f46, #10b981);
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #10b981, #065f46);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(16,185,129,0.4);
        }
        .btn-login:active { transform: translateY(0); }

        input:focus {
            outline: none;
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.15);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-1 { animation: fadeInUp 0.5s ease forwards; }
        .anim-2 { animation: fadeInUp 0.5s ease 0.1s forwards; opacity: 0; }
        .anim-3 { animation: fadeInUp 0.5s ease 0.2s forwards; opacity: 0; }
        .anim-4 { animation: fadeInUp 0.5s ease 0.3s forwards; opacity: 0; }
    </style>
</head>
<body class="min-h-screen bg-pattern flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8 anim-1">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/10 border border-white/20 mb-4">
                <svg class="w-10 h-10 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h1 class="font-amiri text-3xl text-white font-bold">TPQ Al-Mukharijin</h1>
            <p class="text-emerald-300 text-sm mt-1 tracking-wider uppercase">Panel Administrasi</p>
        </div>

        {{-- Card --}}
        <div class="card-login rounded-2xl overflow-hidden anim-2">
            <div class="h-1 bg-gradient-to-r from-emerald-600 via-yellow-500 to-emerald-600"></div>

            <div class="p-8">

                <div class="text-center mb-6">
                    <p class="font-amiri text-2xl text-emerald-800">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                    <div class="ornament mt-3">
                        <span class="text-xs text-amber-600 font-medium tracking-widest uppercase">Masuk ke Sistem</span>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg flex items-center gap-2 text-sm text-emerald-700">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5 anim-3">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Administrator</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="admin@tpq-almukharijin.id"
                                autocomplete="email" autofocus
                                class="w-full border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}
                                       rounded-xl pl-10 pr-4 py-3 text-sm text-gray-800 transition-all placeholder:text-gray-400">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" name="password" id="passwordInput"
                                placeholder="••••••••" autocomplete="current-password"
                                class="w-full border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}
                                       rounded-xl pl-10 pr-11 py-3 text-sm text-gray-800 transition-all placeholder:text-gray-400">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" value="1"
                                class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-login w-full text-white font-semibold py-3.5 rounded-xl text-sm tracking-wide shadow-lg">
                        Masuk ke Dashboard
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-gray-100 anim-4">
                    <p class="text-center text-xs text-gray-400">
                        TPQ Al-Mukharijin &copy; {{ date('Y') }} — Sistem Manajemen
                    </p>
                </div>

            </div>
        </div>

        {{-- Back --}}
        <div class="text-center mt-4 anim-4">
            <a href="{{ route('beranda') }}" class="text-emerald-300 hover:text-white text-sm transition-colors inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke halaman utama
            </a>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }
    </script>
</body>
</html>


