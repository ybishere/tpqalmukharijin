@extends('layouts.app')
@section('title', 'Kegiatan – TPQ Al-Mukharijin')

@section('meta_description', 'Dokumentasi kegiatan TPQ Al-Mukharijin – foto dan agenda kegiatan santri, wisuda, Ramadhan, dan berbagai kegiatan islami lainnya.')
@section('og_title', 'Kegiatan – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO — sama seperti halaman lain ═══ --}}
<section class="relative pt-32 pb-20 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 40%,#064e3b 100%);">
    <div class="pattern-bg absolute inset-0 opacity-30"></div>
    <div class="absolute top-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.4),transparent)"></div>
    <div class="absolute -right-20 top-0 bottom-0 w-96"
        style="background:radial-gradient(circle,rgba(16,185,129,0.05) 0%,transparent 70%)"></div>

    <div class="relative max-w-6xl mx-auto px-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-4 mb-6">
                <div class="h-px w-16"
                    style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.6))"></div>
                <span class="text-amber-400/70 text-[11px] font-bold uppercase tracking-[0.25em]">
                    Dokumentasi Kegiatan
                </span>
            </div>
            <h1 class="font-extrabold text-white leading-tight mb-4"
                style="font-size:clamp(2rem,5vw,3.5rem);">
                Album Kenangan<br>
                <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    TPQ Al-Mukharijin
                </span>
            </h1>
            <p class="text-white/50 text-base leading-relaxed">
                Kumpulan dokumentasi foto kegiatan islami dan edukatif
                yang telah terlaksana di TPQ Al-Mukharijin dari waktu ke waktu.
            </p>
        </div>
    </div>
</section>

{{-- ═══ SLIDER FOTO INTERAKTIF ═══ --}}
<section class="py-16 bg-white" x-data="fotoSlider()" x-init="init()">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="section-label mb-2 block">Sekilas Kenangan</span>
                <h2 class="font-extrabold text-stone-900 text-xl">Foto Kegiatan</h2>
            </div>
            {{-- Counter & arrows --}}
            <div class="flex items-center gap-2">
                <button @click="prev()"
                    class="w-9 h-9 rounded-xl flex items-center justify-center border border-stone-200 hover:border-emerald-400 hover:text-emerald-700 text-stone-500 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <span class="text-stone-400 text-xs font-mono w-12 text-center">
                    <span x-text="String(current+1).padStart(2,'0')"></span>
                    <span class="text-stone-300">/</span>
                    <span x-text="String(fotos.length).padStart(2,'0')"></span>
                </span>
                <button @click="next()"
                    class="w-9 h-9 rounded-xl flex items-center justify-center border border-stone-200 hover:border-emerald-400 hover:text-emerald-700 text-stone-500 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-5 items-start">

            {{-- Foto utama — besar --}}
            <div class="lg:col-span-2">
                <div class="relative overflow-hidden rounded-2xl"
                    style="aspect-ratio:16/10;box-shadow:0 20px 60px rgba(0,0,0,0.1);">

                    <template x-if="fotos.length > 0">
                        <div class="w-full h-full">
                            <template x-for="(foto, i) in fotos" :key="i">
                                <div class="absolute inset-0 transition-all duration-700"
                                    :class="i===current ? 'opacity-100 scale-100' : 'opacity-0 scale-105'">
                                    <img :src="foto.url" :alt="foto.judul"
                                        class="w-full h-full object-cover">
                                </div>
                            </template>

                            {{-- Overlay info bawah --}}
                            <div class="absolute bottom-0 left-0 right-0 p-6"
                                style="background:linear-gradient(to top,rgba(0,0,0,0.8) 0%,rgba(0,0,0,0.4) 50%,transparent 100%)">
                                <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold text-white/80 mb-2"
                                    style="background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);">
                                    📸 Dokumentasi
                                </span>
                                <h3 class="text-white font-extrabold text-lg leading-tight mb-1"
                                    x-text="fotos[current]?.judul ?? ''"></h3>
                                <p class="text-white/55 text-sm" x-text="fotos[current]?.tanggal ?? ''"></p>
                                <p class="text-white/40 text-xs mt-1 line-clamp-1"
                                    x-text="fotos[current]?.keterangan ?? ''"></p>
                            </div>

                            {{-- Progress bar --}}
                            <div class="absolute top-0 left-0 right-0 h-0.5 bg-white/10">
                                <div class="h-full bg-amber-400 transition-all duration-300"
                                    :style="`width:${((current+1)/fotos.length)*100}%`"></div>
                            </div>

                            {{-- Tombol pause/play --}}
                            <button @click="togglePlay()"
                                class="absolute top-4 right-4 w-8 h-8 rounded-full flex items-center justify-center transition-all"
                                style="background:rgba(0,0,0,0.3);backdrop-filter:blur(8px);"
                                onmouseenter="this.style.background='rgba(0,0,0,0.5)'"
                                onmouseleave="this.style.background='rgba(0,0,0,0.3)'">
                                <svg x-show="playing" class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                                </svg>
                                <svg x-show="!playing" class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <template x-if="fotos.length === 0">
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-3"
                            style="background:#f0fdf4;">
                            <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-emerald-400 text-sm">Belum ada foto kegiatan</p>
                        </div>
                    </template>
                </div>

                {{-- Dots --}}
                <div class="flex gap-1.5 mt-4 justify-center flex-wrap" x-show="fotos.length > 1">
                    <template x-for="(f,i) in fotos" :key="i">
                        <button @click="goTo(i)"
                            class="rounded-full transition-all duration-300"
                            :class="i===current
                                ? 'w-6 h-2 bg-emerald-600'
                                : 'w-2 h-2 bg-stone-300 hover:bg-stone-400'">
                        </button>
                    </template>
                </div>
            </div>

            {{-- Kanan: Thumbnail list --}}
            <div class="lg:col-span-1">
                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-3">
                    Semua Foto ({{ count($allPhotos) }})
                </p>
                <div class="space-y-2 max-h-[420px] overflow-y-auto pr-1"
                    style="scrollbar-width:thin;scrollbar-color:#d1d5db transparent;">
                    <template x-for="(foto, i) in fotos" :key="i">
                        <button @click="goTo(i)"
                            class="w-full flex items-center gap-3 p-2 rounded-xl transition-all text-left"
                            :class="i===current
                                ? 'bg-emerald-50 border border-emerald-200'
                                : 'hover:bg-stone-50 border border-transparent'">
                            <div class="shrink-0 w-16 h-12 rounded-lg overflow-hidden">
                                <img :src="foto.url" :alt="foto.judul"
                                    class="w-full h-full object-cover transition-transform duration-300"
                                    :class="i===current ? 'scale-110' : 'scale-100'">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold leading-snug line-clamp-2"
                                    :class="i===current ? 'text-emerald-800' : 'text-stone-700'"
                                    x-text="foto.judul"></p>
                                <p class="text-[10px] mt-0.5"
                                    :class="i===current ? 'text-emerald-500' : 'text-stone-400'"
                                    x-text="foto.tanggal"></p>
                            </div>
                            <div x-show="i===current"
                                class="shrink-0 w-1.5 h-8 rounded-full bg-emerald-500"></div>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ DAFTAR KEGIATAN ═══ --}}
<section class="py-20 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
            <div>
                <span class="section-label mb-3 block">Semua Kegiatan</span>
                <h2 class="font-extrabold text-stone-900 leading-tight"
                    style="font-size:clamp(1.6rem,3vw,2.2rem);">
                    Daftar Dokumentasi
                </h2>
            </div>
            <p class="text-stone-400 text-sm">{{ $kegiatan->total() }} kegiatan terdokumentasi</p>
        </div>

        @if($kegiatan->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kegiatan as $item)
            <a href="{{ route('kegiatan.show', $item->id) }}"
                class="fade-up card group block overflow-hidden">

                <div class="relative overflow-hidden" style="aspect-ratio:4/3;">
                    @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @elseif($item->photos->first())
                        <img src="{{ Storage::url($item->photos->first()->foto) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center"
                            style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);">
                            <svg class="w-14 h-14 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Hover overlay --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"
                        style="background:rgba(6,78,59,0.5);">
                        <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Jumlah foto --}}
                    @if($item->photos->count() > 0)
                    <div class="absolute bottom-3 right-3">
                        <span class="flex items-center gap-1 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full"
                            style="background:rgba(0,0,0,0.5);backdrop-filter:blur(8px);">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                            </svg>
                            {{ $item->photos->count() }} foto
                        </span>
                    </div>
                    @endif
                </div>

                <div class="p-5">
                    <p class="text-stone-400 text-xs mb-2 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </p>
                    <h3 class="font-bold text-stone-900 leading-snug line-clamp-2 group-hover:text-emerald-800 transition-colors">
                        {{ $item->judul }}
                    </h3>
                    @if($item->deskripsi)
                    <p class="text-stone-400 text-xs mt-2 line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</p>
                    @endif
                    <div class="mt-4 flex items-center gap-1.5 text-emerald-700 text-xs font-semibold">
                        Lihat Album
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($kegiatan->hasPages())
        <div class="mt-12 flex items-center justify-center gap-2">
            @if($kegiatan->onFirstPage())
            <span class="w-10 h-10 rounded-xl flex items-center justify-center text-stone-300 cursor-not-allowed border border-stone-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </span>
            @else
            <a href="{{ $kegiatan->previousPageUrl() }}"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-stone-600 border border-stone-200 hover:border-emerald-300 hover:text-emerald-700 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            @endif

            @foreach($kegiatan->getUrlRange(1, $kegiatan->lastPage()) as $page => $url)
            @if($page == $kegiatan->currentPage())
            <span class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold text-white"
                style="background:linear-gradient(135deg,#064e3b,#065f46);">{{ $page }}</span>
            @else
            <a href="{{ $url }}"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-medium text-stone-600 border border-stone-200 hover:border-emerald-300 hover:text-emerald-700 transition-all">
                {{ $page }}
            </a>
            @endif
            @endforeach

            @if($kegiatan->hasMorePages())
            <a href="{{ $kegiatan->nextPageUrl() }}"
                class="w-10 h-10 rounded-xl flex items-center justify-center text-stone-600 border border-stone-200 hover:border-emerald-300 hover:text-emerald-700 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @else
            <span class="w-10 h-10 rounded-xl flex items-center justify-center text-stone-300 cursor-not-allowed border border-stone-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
            @endif
        </div>
        @endif

        @else
        <div class="text-center py-20 border-2 border-dashed border-stone-200 rounded-3xl">
            <svg class="w-12 h-12 text-stone-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-stone-400 text-sm">Belum ada dokumentasi kegiatan.</p>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
function fotoSlider() {
    return {
        current: 0,
        playing: true,
        timer: null,
        fotos: @json($allPhotos),
        init() {
            if (this.fotos.length > 1) this.autoPlay();
        },
        autoPlay() {
            this.timer = setInterval(() => this.next(), 4000);
        },
        next() { this.current = (this.current + 1) % Math.max(this.fotos.length, 1); },
        prev() { this.current = (this.current - 1 + Math.max(this.fotos.length, 1)) % Math.max(this.fotos.length, 1); },
        goTo(i) {
            this.current = i;
            clearInterval(this.timer);
            if (this.playing) this.autoPlay();
        },
        togglePlay() {
            this.playing = !this.playing;
            if (this.playing) {
                this.autoPlay();
            } else {
                clearInterval(this.timer);
            }
        }
    }
}

const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
</script>
@endpush