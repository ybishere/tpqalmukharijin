@extends('layouts.app')

@section('title', 'Beranda — TPQ Al-Mukharijin')

@section('content')

{{-- ===== HERO ===== --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background: linear-gradient(160deg, #022c22 0%, #064e3b 40%, #065f46 70%, #047857 100%);">

    {{-- Islamic pattern --}}
    <div class="absolute inset-0 islamic-pattern opacity-60"></div>

    {{-- Radial glows --}}
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>

    {{-- Ornamen lingkaran --}}
    <div class="absolute top-20 right-10 w-64 h-64 border border-white/5 rounded-full"></div>
    <div class="absolute top-20 right-10 w-48 h-48 border border-white/5 rounded-full translate-x-8 translate-y-8"></div>
    <div class="absolute bottom-20 left-10 w-48 h-48 border border-white/5 rounded-full"></div>

    <div class="relative max-w-4xl mx-auto px-5 text-center pt-28 pb-32">

        {{-- Arabic bismillah --}}
        <div class="mb-6">
            <p class="font-amiri text-amber-300 text-3xl md:text-4xl leading-relaxed">
                بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ
            </p>
        </div>

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/80 text-xs font-medium px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-pulse"></span>
            TPQ Al-Mukharijin · Desa Kreman
        </div>

        {{-- Heading --}}
        <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-5">
            Bantu Santri Kami<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-500">
                Meraih Cahaya Ilmu
            </span>
        </h1>

        {{-- Subheading --}}
        <p class="text-white/70 text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-8">
            Setiap donasi Anda adalah investasi akhirat yang nyata.
            Semua tercatat, transparan, dan bisa dipantau kapan saja.
        </p>

        {{-- Ornament --}}
        <div class="ornament-divider max-w-xs mx-auto mb-8">
            <span class="text-amber-400 text-xs tracking-widest uppercase font-medium">Bergabung Bersama Kami</span>
        </div>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('program.index') }}"
                class="btn-gold text-white font-bold px-8 py-4 rounded-2xl text-sm inline-flex items-center justify-center gap-2 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Donasi Sekarang
            </a>
            <a href="{{ route('laporan.publik') }}"
                class="bg-white/10 hover:bg-white/20 border border-white/25 text-white font-semibold px-8 py-4 rounded-2xl text-sm inline-flex items-center justify-center gap-2 transition-all backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Lihat Laporan
            </a>
        </div>

        {{-- Scroll indicator --}}
        <div class="mt-16 flex flex-col items-center gap-2 animate-bounce">
            <span class="text-white/40 text-xs">Scroll ke bawah</span>
            <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>
</section>

{{-- ===== STATISTIK ===== --}}
<section class="relative z-10 max-w-5xl mx-auto px-5 -mt-16">
    <div class="grid grid-cols-3 gap-4">

        <div class="fade-up bg-white rounded-2xl shadow-xl border border-gray-100 p-5 md:p-7 text-center card-hover">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-lg md:text-2xl font-extrabold text-emerald-700 leading-tight">
                Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}
            </p>
            <p class="text-xs text-gray-400 mt-1 font-medium">Total Dana Terkumpul</p>
        </div>

        <div class="fade-up bg-white rounded-2xl shadow-xl border border-gray-100 p-5 md:p-7 text-center card-hover" style="transition-delay:0.1s">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <p class="text-lg md:text-2xl font-extrabold text-amber-600 leading-tight">{{ $totalProgram ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-1 font-medium">Program Aktif</p>
        </div>

        <div class="fade-up bg-white rounded-2xl shadow-xl border border-gray-100 p-5 md:p-7 text-center card-hover" style="transition-delay:0.2s">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-lg md:text-2xl font-extrabold text-blue-600 leading-tight">{{ $totalDonatur ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-1 font-medium">Total Donatur</p>
        </div>

    </div>
</section>

{{-- ===== PROGRAM AKTIF ===== --}}
<section class="max-w-5xl mx-auto px-5 mt-20">

    <div class="fade-up text-center mb-10">
        <p class="text-xs font-bold text-amber-600 uppercase tracking-widest mb-2">Program Kebutuhan</p>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Program yang Butuh Dukungan Anda</h2>
        <div class="ornament-divider max-w-xs mx-auto">
            <span class="text-xs text-amber-600 font-medium">Pilih program untuk berdonasi</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($programs as $i => $program)
        @php
            $persen = $program->target_dana > 0
                ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
                : 0;
            $colors = [
                ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'bar' => 'from-emerald-500 to-emerald-400', 'badge' => 'bg-emerald-100 text-emerald-700'],
                ['bg' => 'bg-amber-50',   'border' => 'border-amber-200',   'bar' => 'from-amber-500 to-amber-400',   'badge' => 'bg-amber-100 text-amber-700'],
                ['bg' => 'bg-blue-50',    'border' => 'border-blue-200',    'bar' => 'from-blue-500 to-blue-400',    'badge' => 'bg-blue-100 text-blue-700'],
                ['bg' => 'bg-purple-50',  'border' => 'border-purple-200',  'bar' => 'from-purple-500 to-purple-400','badge' => 'bg-purple-100 text-purple-700'],
            ];
            $c = $colors[$i % 4];
        @endphp
        <div class="fade-up bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden card-hover group"
            style="transition-delay: {{ $i * 0.1 }}s">

            {{-- Top accent --}}
            <div class="h-1 bg-gradient-to-r {{ $c['bar'] }}"></div>

            <div class="p-6">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <h3 class="font-bold text-gray-800 text-base leading-snug group-hover:text-emerald-700 transition-colors">
                        {{ $program->nama_program }}
                    </h3>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full flex-shrink-0 {{ $c['badge'] }}">
                        Aktif
                    </span>
                </div>

                <p class="text-sm text-gray-500 leading-relaxed mb-5">{{ Str::limit($program->deskripsi, 100) }}</p>

                {{-- Progress --}}
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs text-gray-400">Terkumpul</span>
                        <span class="text-xs font-bold text-emerald-600">{{ $persen }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-gradient-to-r {{ $c['bar'] }} h-2.5 rounded-full transition-all duration-1000"
                            style="width: {{ $persen }}%"></div>
                    </div>
                </div>

                {{-- Amount + CTA --}}
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-base font-extrabold text-gray-800">
                            Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-400">
                            dari Rp {{ number_format($program->target_dana, 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('program.detail', $program->id_program) }}"
                        class="btn-gold text-white text-xs font-bold px-5 py-2.5 rounded-xl inline-flex items-center gap-1.5">
                        Donasi
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-16 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            Belum ada program aktif saat ini.
        </div>
        @endforelse
    </div>

    <div class="text-center mt-8 fade-up">
        <a href="{{ route('program.index') }}"
            class="inline-flex items-center gap-2 border-2 border-emerald-700 text-emerald-700 hover:bg-emerald-700 hover:text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-all">
            Lihat Semua Program
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</section>

{{-- ===== KENAPA KAMI ===== --}}
<section class="mt-20 py-16 relative overflow-hidden"
    style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);">
    <div class="islamic-pattern absolute inset-0 opacity-40"></div>
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>

    <div class="relative max-w-5xl mx-auto px-5">
        <div class="fade-up text-center mb-12">
            <p class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-2">Komitmen Kami</p>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Mengapa Donasi di Sini?</h2>
            <div class="ornament-divider max-w-xs mx-auto">
                <span class="text-xs text-amber-400 font-medium">Transparan & Terpercaya</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Transparan', 'desc' => 'Setiap rupiah dicatat dan bisa dipantau publik kapan saja melalui laporan terbuka.', 'color' => 'emerald'],
                ['icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Terlapor', 'desc' => 'Laporan keuangan tersedia lengkap dan diperbarui secara berkala setiap bulan.', 'color' => 'amber'],
                ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Tepat Sasaran', 'desc' => 'Dana langsung digunakan untuk kebutuhan nyata santri TPQ Al-Mukharijin.', 'color' => 'blue'],
            ] as $i => $item)
            <div class="fade-up bg-white/8 border border-white/10 rounded-2xl p-6 text-center backdrop-blur-sm hover:bg-white/12 transition-all card-hover"
                style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-14 h-14 rounded-2xl bg-{{ $item['color'] }}-500/20 border border-{{ $item['color'] }}-400/30 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-{{ $item['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-bold text-white mb-2">{{ $item['title'] }}</h3>
                <p class="text-white/60 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CARA BERDONASI ===== --}}
<section class="max-w-5xl mx-auto px-5 mt-20 mb-4">
    <div class="fade-up text-center mb-10">
        <p class="text-xs font-bold text-amber-600 uppercase tracking-widest mb-2">Mudah & Cepat</p>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Cara Berdonasi</h2>
        <div class="ornament-divider max-w-xs mx-auto">
            <span class="text-xs text-amber-600 font-medium">Hanya 3 langkah mudah</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        @foreach([
            ['step' => '1', 'title' => 'Pilih Program', 'desc' => 'Pilih program donasi yang ingin Anda dukung dari daftar program aktif kami.'],
            ['step' => '2', 'title' => 'Isi Formulir', 'desc' => 'Isi nama dan nominal donasi. Nama boleh dikosongkan jika ingin anonim.'],
            ['step' => '3', 'title' => 'Selesaikan Pembayaran', 'desc' => 'Bayar via QRIS, GoPay, OVO, transfer bank, atau metode lainnya.'],
        ] as $i => $step)
        <div class="fade-up text-center" style="transition-delay: {{ $i * 0.15 }}s">
            <div class="relative inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                style="background: linear-gradient(135deg, #064e3b, #10b981)">
                <span class="text-white font-extrabold text-xl">{{ $step['step'] }}</span>
                @if ($i < 2)
                <div class="hidden md:block absolute left-full top-1/2 -translate-y-1/2 w-full h-px border-t-2 border-dashed border-emerald-200 ml-3"></div>
                @endif
            </div>
            <h3 class="font-bold text-gray-800 mb-2">{{ $step['title'] }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- CTA Bottom --}}
    <div class="fade-up relative overflow-hidden rounded-3xl p-10 md:p-14 text-center"
        style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%)">
        <div class="islamic-pattern absolute inset-0 opacity-50"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-amber-400/60 to-transparent"></div>

        <div class="relative">
            <p class="font-amiri text-amber-300 text-2xl mb-4">مَنْ ذَا الَّذِي يُقْرِضُ اللَّهَ قَرْضًا حَسَنًا</p>
            <p class="text-white/60 text-xs mb-6">"Siapakah yang mau meminjamkan kepada Allah pinjaman yang baik..." (QS. Al-Baqarah: 245)</p>
            <h2 class="text-xl md:text-2xl font-bold text-white mb-2">Siap Berbagi Kebaikan?</h2>
            <p class="text-white/70 text-sm mb-8 max-w-md mx-auto">
                Donasi Anda, sekecil apapun, sangat berarti bagi santri-santri kami.
            </p>
            <a href="{{ route('program.index') }}"
                class="btn-gold text-white font-bold px-10 py-4 rounded-2xl text-sm inline-flex items-center gap-2 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Mulai Donasi Sekarang
            </a>
        </div>
    </div>
</section>

@endsection