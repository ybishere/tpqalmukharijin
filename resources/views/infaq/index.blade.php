@extends('layouts.app')
@section('title', 'Infaq Kamisan – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative pt-32 pb-24 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 40%,#064e3b 100%);">
    <div class="pattern-bg absolute inset-0 opacity-30"></div>
    <div class="absolute top-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.4),transparent)"></div>

    <div class="relative max-w-6xl mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">

            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16" style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.5))"></div>
                <span class="text-emerald-400/70 text-[11px] font-bold uppercase tracking-[0.25em]">Tradisi Kamisan</span>
                <div class="h-px w-16" style="background:linear-gradient(to left,transparent,rgba(217,119,6,0.5))"></div>
            </div>

            <p class="font-arabic text-amber-300 text-3xl md:text-4xl leading-loose mb-3">
                وَأَنفِقُوا فِي سَبِيلِ اللَّهِ
            </p>
            <p class="text-white/35 text-sm italic mb-8">
                "Dan infaqkanlah di jalan Allah." (QS. Al-Baqarah: 195)
            </p>

            <h1 class="font-extrabold text-white leading-tight mb-5"
                style="font-size:clamp(2rem,5vw,3.5rem);">
                Infaq Kamisan<br>
                <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    TPQ Al-Mukharijin
                </span>
            </h1>
            <p class="text-white/55 text-base leading-relaxed max-w-xl mx-auto">
                Tradisi infaq setelah mengaji setiap hari Kamis — kini hadir secara digital.
                Infaqkan berapapun yang Anda ikhlas, tanpa minimum, tanpa target.
            </p>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 60L1440 60L1440 20C1200 60 960 0 720 20C480 40 240 0 0 20L0 60Z" fill="#fafaf9"/>
        </svg>
    </div>
</section>

{{-- ═══ CERITA TRADISI ═══ --}}
<section class="pt-16 pb-4 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="max-w-3xl mx-auto fade-up">

            <div class="text-center mb-10">
                <span class="section-label mb-3 justify-center" style="display:inline-flex;background:rgba(245,158,11,0.1);color:#b45309;">Tentang Infaq Kamisan</span>
                <h2 class="font-extrabold text-stone-900 leading-tight"
                    style="font-size:clamp(1.6rem,3vw,2.2rem);">
                    Tradisi Sederhana, Berkah Luar Biasa
                </h2>
            </div>

            <div class="text-stone-600 text-sm leading-relaxed space-y-4 mb-10">
                <p>
                    Sudah menjadi tradisi di TPQ Al-Mukharijin — setiap hari Kamis, setelah sesi mengaji selesai,
                    para santri dan wali santri mengumpulkan infaq seikhlasnya. Tradisi ini bukan sekadar
                    rutinitas, melainkan sebuah pembiasaan agar generasi muda tumbuh dengan jiwa dermawan
                    dan kepedulian terhadap sesama.
                </p>
                <p>
                    Dana yang terkumpul dari Infaq Kamisan digunakan sepenuhnya untuk mendukung operasional
                    TPQ dan kesejahteraan para pengajar — mereka yang dengan ikhlas mendedikasikan waktu dan
                    ilmunya demi anak-anak Desa Kreman bisa membaca dan mencintai Al-Quran.
                </p>
                <p>
                    Kini tradisi ini hadir secara digital — Anda dapat berinfaq kapan saja, dari mana saja,
                    melalui QRIS. Semoga setiap infaq yang Anda berikan menjadi amal jariyah yang terus
                    mengalir pahalanya.
                </p>
            </div>

            {{-- Dampak infaq --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                @foreach([
                    ['icon' => '👨‍🏫', 'judul' => 'Mendukung Pengajar', 'desc' => 'Infaq Anda membantu memberikan apresiasi bagi para pengajar yang mendedikasikan waktu tanpa pamrih.'],
                    ['icon' => '🏫', 'judul' => 'Operasional TPQ', 'desc' => 'Membantu kebutuhan operasional harian TPQ agar kegiatan belajar mengajar terus berjalan lancar.'],
                    ['icon' => '🌱', 'judul' => 'Amal Jariyah', 'desc' => 'Setiap infaq yang Anda berikan insyaAllah akan terus mengalir pahalanya selama ilmu Al-Quran diamalkan.'],
                ] as $dampak)
                <div class="text-center p-5 rounded-2xl bg-white border border-stone-100 shadow-sm">
                    <div class="text-3xl mb-3">{{ $dampak['icon'] }}</div>
                    <h4 class="font-bold text-stone-800 text-sm mb-2">{{ $dampak['judul'] }}</h4>
                    <p class="text-stone-500 text-xs leading-relaxed">{{ $dampak['desc'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>

{{-- ═══ QRIS ═══ --}}
<section class="py-16 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="max-w-md mx-auto fade-up text-center">

            <span class="section-label mb-3 justify-center" style="display:inline-flex;background:rgba(245,158,11,0.1);color:#b45309;">Infaq Digital</span>
            <h2 class="font-extrabold text-stone-900 text-2xl mb-3">Scan QRIS untuk Berinfaq</h2>
            <p class="text-stone-500 text-sm mb-8">
                Berlaku untuk semua e-wallet dan m-banking — GoPay, Dana, OVO, ShopeePay, BCA, Mandiri, dan lainnya.
            </p>

            <div class="bg-white rounded-3xl p-8 shadow-sm border border-amber-100">
                {{-- Placeholder QRIS --}}
                <div class="w-56 h-56 mx-auto rounded-2xl mb-6 flex items-center justify-center"
                    style="background:#f5f5f4;">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-stone-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                        <p class="text-sm font-semibold text-stone-400">QRIS segera hadir</p>
                        <p class="text-xs text-stone-300 mt-1">Hubungi admin untuk info lebih lanjut</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-xs font-semibold text-stone-600">Cara berinfaq:</p>
                    @foreach([
                        'Buka aplikasi e-wallet atau m-banking Anda',
                        'Pilih menu Scan QR / QRIS',
                        'Arahkan kamera ke QR Code di atas',
                        'Masukkan nominal infaq seikhlasnya',
                        'Konfirmasi pembayaran',
                    ] as $i => $step)
                    <div class="flex items-center gap-3 text-left">
                        <span class="w-5 h-5 rounded-full bg-amber-500 text-white text-[10px] font-bold flex items-center justify-center shrink-0">{{ $i+1 }}</span>
                        <p class="text-xs text-stone-500">{{ $step }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- WA konfirmasi --}}
            @if($profil?->no_telp)
            <div class="mt-6">
                <p class="text-xs text-stone-400 mb-3">Ingin konfirmasi atau bertanya? Hubungi kami via WhatsApp</p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_telp) }}?text=Assalamualaikum, saya ingin konfirmasi infaq kamisan TPQ Al-Mukharijin"
                    target="_blank"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-2xl text-sm transition">
                    💬 Konfirmasi via WhatsApp
                </a>
            </div>
            @endif

        </div>
    </div>
</section>

{{-- ═══ CTA DONASI ═══ --}}
<section class="pb-20 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="fade-up rounded-3xl p-8 text-center"
            style="background:linear-gradient(135deg,#022c22,#064e3b);">
            <p class="text-amber-300 text-[11px] font-bold uppercase tracking-widest mb-3">Ingin Donasi Program?</p>
            <h3 class="font-extrabold text-white text-xl mb-3">
                Dukung Program TPQ dengan Donasi Terprogram
            </h3>
            <p class="text-white/50 text-sm mb-6 max-w-md mx-auto">
                Selain Infaq Kamisan, kami juga memiliki program donasi dengan target dana jelas
                dan laporan penggunaan yang transparan.
            </p>
            <a href="{{ route('donasi.landing') }}"
                class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-400 text-white font-semibold px-8 py-3 rounded-2xl text-sm transition">
                Lihat Program Donasi →
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            if (e.target.classList.contains('fade-up')) e.target.classList.add('visible');
            io.unobserve(e.target);
        }
    });
}, { threshold: 0.15 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
</script>
@endpush