@extends('layouts.app')
@section('title', 'In Memoriam – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative pt-32 pb-24 overflow-hidden"
    style="background:linear-gradient(135deg,#1a1208 0%,#2d1f0a 40%,#3d2b0f 70%,#2a1a08 100%);">

    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px]"
        style="background:radial-gradient(circle,rgba(245,158,11,0.08) 0%,transparent 65%)"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64"
        style="background:radial-gradient(circle,rgba(6,78,59,0.12) 0%,transparent 70%)"></div>
    <div class="absolute top-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.5),transparent)"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.2),transparent)"></div>

    <div class="relative max-w-5xl mx-auto px-6 text-center">
        <div class="flex items-center justify-center gap-4 mb-8">
            <div class="h-px flex-1 max-w-24" style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.6))"></div>
            <span class="text-amber-500 text-xl">✦</span>
            <div class="h-px flex-1 max-w-24" style="background:linear-gradient(to left,transparent,rgba(217,119,6,0.6))"></div>
        </div>

        <span class="inline-block text-amber-400/80 text-[11px] font-bold uppercase tracking-[0.25em] mb-5">
            Mengenang Jasa Beliau
        </span>

        <h1 class="font-extrabold leading-tight mb-6 text-white"
            style="font-size:clamp(2.5rem,6vw,4rem);">
            In <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Memoriam</span>
        </h1>

        <p class="font-arabic text-amber-300 text-3xl md:text-4xl leading-loose mb-3">
            كُلُّ نَفْسٍ ذَائِقَةُ الْمَوْتِ
        </p>
        <p class="text-white/35 text-sm italic mb-8">
            "Setiap jiwa pasti akan merasakan kematian." (QS. Ali Imran: 185)
        </p>

        <div class="flex items-center justify-center gap-4">
            <div class="h-px flex-1 max-w-24" style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.3))"></div>
            <span class="text-amber-400/30 font-arabic text-sm">رحمه الله</span>
            <div class="h-px flex-1 max-w-24" style="background:linear-gradient(to left,transparent,rgba(217,119,6,0.3))"></div>
        </div>
    </div>
</section>

{{-- ═══ KONTEN MEMORIAM ═══ --}}
<section class="py-24" style="background:linear-gradient(180deg,#2a1a08 0%,#fafaf9 8%,#fafaf9 100%);">
    <div class="max-w-5xl mx-auto px-6">

        @forelse($memoriam as $tokoh)
        <div class="fade-up mb-28 last:mb-0">

            {{-- ── PROFIL + SLIDER FOTO ── --}}
            <div class="grid lg:grid-cols-5 gap-10 items-start mb-12">

                {{-- Kiri: Profil --}}
                <div class="lg:col-span-2 text-center lg:text-left">

                    {{-- Foto profil --}}
                    <div class="relative inline-block mb-6">
                        @if($tokoh->foto)
                            <img src="{{ Storage::url($tokoh->foto) }}" alt="{{ $tokoh->nama }}"
                                class="w-44 h-44 rounded-3xl object-cover mx-auto lg:mx-0"
                                style="box-shadow:0 20px 60px rgba(180,83,9,0.15);border:3px solid rgba(245,158,11,0.2);">
                        @else
                            <div class="w-44 h-44 rounded-3xl mx-auto lg:mx-0 flex items-center justify-center"
                                style="background:linear-gradient(135deg,#fef3c7,#fde68a);border:3px solid rgba(245,158,11,0.25);box-shadow:0 20px 60px rgba(180,83,9,0.12);">
                                <svg class="w-20 h-20 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Badge tahun wafat --}}
                        @if($tokoh->tahun_wafat)
                        <div class="absolute -bottom-3 left-1/2 lg:left-auto lg:right-0 -translate-x-1/2 lg:translate-x-1/2"
                            style="background:linear-gradient(135deg,#064e3b,#065f46);color:white;font-size:11px;font-weight:700;padding:4px 12px;border-radius:100px;white-space:nowrap;border:2px solid white;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                            Wafat {{ $tokoh->tahun_wafat }}
                        </div>
                        @endif
                    </div>

                    <h2 class="font-extrabold text-stone-900 text-xl md:text-2xl leading-tight mb-1 mt-4">
                        {{ $tokoh->nama }}
                    </h2>

                    @if($tokoh->tahun_lahir && $tokoh->tahun_wafat)
                    <p class="text-stone-400 text-sm mb-4">
                        {{ $tokoh->tahun_lahir }} – {{ $tokoh->tahun_wafat }}
                        <span class="mx-1.5 text-stone-300">·</span>
                        {{ $tokoh->tahun_wafat - $tokoh->tahun_lahir }} tahun
                    </p>
                    @endif

                    <span style="background:linear-gradient(135deg,#fef3c7,#fde68a);color:#92400e;font-size:11px;font-weight:700;padding:4px 14px;border-radius:100px;border:1px solid rgba(180,83,9,0.2);">
                        Pendiri & Pengasuh
                    </span>

                    @if($tokoh->biografi)
                    <p class="text-stone-500 text-sm leading-relaxed mt-5">
                        {{ $tokoh->biografi }}
                    </p>
                    @endif
                </div>

                {{-- Kanan: Slider foto kenangan --}}
                <div class="lg:col-span-3"
                    x-data="fotoSlider({{ $tokoh->photos->count() }})"
                    x-init="init()">

                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-4 flex items-center gap-3">
                        <span>Foto Kenangan</span>
                        <span class="flex-1 h-px bg-stone-200"></span>
                        @if($tokoh->photos->count() > 0)
                        <span class="text-amber-600" x-text="(current+1)+'/'+total"></span>
                        @endif
                    </p>

                    {{-- Slider frame --}}
                    <div class="relative overflow-hidden rounded-2xl"
                        style="aspect-ratio:16/10;box-shadow:0 24px 60px rgba(0,0,0,0.1);border:1px solid rgba(0,0,0,0.06);">

                        @if($tokoh->photos->count() > 0)

                            {{-- Slides --}}
                            <div class="flex h-full transition-transform duration-600 ease-in-out"
                                :style="`transform:translateX(-${current * (100/total)}%);width:${total*100}%`">
                                @foreach($tokoh->photos as $photo)
                                <div class="h-full relative flex-shrink-0" style="width:{{ 100/$tokoh->photos->count() }}%">
                                    <img src="{{ Storage::url($photo->foto) }}"
                                        alt="{{ $photo->keterangan ?? $tokoh->nama }}"
                                        class="w-full h-full object-cover">
                                    @if($photo->keterangan)
                                    <div class="absolute bottom-0 left-0 right-0 p-4"
                                        style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent)">
                                        <p class="text-white text-sm font-medium">{{ $photo->keterangan }}</p>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>

                            {{-- Controls --}}
                            @if($tokoh->photos->count() > 1)
                            <button @click="prev()"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center transition-all"
                                style="background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);box-shadow:0 4px 12px rgba(0,0,0,0.15);"
                                onmouseenter="this.style.background='white'"
                                onmouseleave="this.style.background='rgba(255,255,255,0.9)'">
                                <svg class="w-4 h-4 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button @click="next()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center transition-all"
                                style="background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);box-shadow:0 4px 12px rgba(0,0,0,0.15);"
                                onmouseenter="this.style.background='white'"
                                onmouseleave="this.style.background='rgba(255,255,255,0.9)'">
                                <svg class="w-4 h-4 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            {{-- Dots --}}
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5">
                                <template x-for="(p,i) in total" :key="i">
                                    <button @click="goTo(i)"
                                        class="rounded-full transition-all duration-300"
                                        :class="i===current?'w-5 h-2 bg-white':'w-2 h-2 bg-white/50'">
                                    </button>
                                </template>
                            </div>
                            @endif

                        @else
                            {{-- Placeholder jika belum ada foto --}}
                            <div class="w-full h-full flex flex-col items-center justify-center gap-4"
                                style="background:linear-gradient(135deg,#fef9ec,#fef3c7);">
                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                                    style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);">
                                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-amber-600/60 text-sm font-medium">Foto kenangan belum tersedia</p>
                                <p class="text-amber-500/40 text-xs">Dapat ditambahkan melalui panel admin</p>
                            </div>
                        @endif
                    </div>

                    {{-- Thumbnail strip --}}
                    @if($tokoh->photos->count() > 1)
                    <div class="flex gap-2 mt-3 overflow-x-auto pb-1">
                        @foreach($tokoh->photos as $pi => $photo)
                        <button @click="goTo({{ $pi }})"
                            class="shrink-0 w-14 h-14 rounded-xl overflow-hidden transition-all duration-200"
                            :class="{{ $pi }}===current?'ring-2 ring-amber-400 ring-offset-1 opacity-100':'opacity-50 hover:opacity-80'">
                            <img src="{{ Storage::url($photo->foto) }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- ── WASIAT & QUOTES ── --}}
            @if($tokoh->quotes && $tokoh->quotes->count())
            <div class="relative">
                {{-- Label --}}
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-px flex-1" style="background:linear-gradient(to right,rgba(217,119,6,0.2),transparent)"></div>
                    <span class="text-amber-600 text-[11px] font-bold uppercase tracking-[0.2em] flex items-center gap-2">
                        <span>✦</span> Wasiat & Nasehat yang Dikenang <span>✦</span>
                    </span>
                    <div class="h-px flex-1" style="background:linear-gradient(to left,rgba(217,119,6,0.2),transparent)"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    @foreach($tokoh->quotes as $q)
                    <div class="relative p-7 rounded-2xl overflow-hidden"
                        style="background:linear-gradient(135deg,#fffbeb,#fef9ec);border:1px solid rgba(245,158,11,0.15);box-shadow:0 4px 24px rgba(180,83,9,0.05);">
                        {{-- Ornamen kutip besar --}}
                        <span class="absolute top-3 right-5 font-serif leading-none select-none"
                            style="font-size:80px;color:rgba(245,158,11,0.08);font-family:Georgia,serif;line-height:1;">"</span>
                        {{-- Garis emas kiri --}}
                        <div class="absolute left-0 top-6 bottom-6 w-0.5 rounded-full"
                            style="background:linear-gradient(to bottom,transparent,#d97706,transparent)"></div>
                        <p class="text-stone-600 text-sm leading-relaxed italic relative z-10 mb-5">
                            "{{ $q->quote }}"
                        </p>
                        <div class="flex items-center gap-2 relative z-10">
                            <div class="w-5 h-px bg-amber-400"></div>
                            <p class="text-amber-700 text-[11px] font-bold">{{ $tokoh->nama }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Divider antar tokoh --}}
            @if(!$loop->last)
            <div class="mt-24 flex items-center justify-center gap-6">
                <div class="h-px flex-1" style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.2))"></div>
                <div class="flex items-center gap-3 text-amber-400/40">
                    <span class="text-sm">✦</span>
                    <span class="font-arabic text-xl">رحمه الله</span>
                    <span class="text-sm">✦</span>
                </div>
                <div class="h-px flex-1" style="background:linear-gradient(to left,transparent,rgba(217,119,6,0.2))"></div>
            </div>
            @endif

        </div>
        @empty
        <div class="text-center py-20">
            <p class="text-stone-400 text-sm">Belum ada data.</p>
        </div>
        @endforelse

        {{-- Doa penutup --}}
        <div class="mt-20 text-center fade-up">
            <div class="inline-block p-10 rounded-3xl"
                style="background:linear-gradient(135deg,#fffbeb,#fef9ec);border:1px solid rgba(245,158,11,0.2);box-shadow:0 8px 40px rgba(180,83,9,0.08);">
                <p class="font-arabic text-amber-700 text-3xl md:text-4xl leading-loose mb-3">
                    اَللّٰهُمَّ اغْفِرْ لَهُمْ وَارْحَمْهُمْ
                </p>
                <p class="text-stone-400 text-xs italic">
                    "Ya Allah, ampunilah mereka dan sayangilah mereka."
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ NAVIGASI LANJUT ═══ --}}
<section class="py-12 bg-white border-t border-stone-100">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-stone-400 text-sm">Kenali juga pengasuh & pengajar yang masih aktif</p>
        <a href="{{ route('profil.pengasuh') }}" class="btn-primary" style="font-size:13px;padding:10px 22px;">
            Pengasuh & Pengajar Aktif
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
function fotoSlider(total) {
    return {
        current: 0,
        total: total,
        timer: null,
        init() {
            if (this.total > 1) this.timer = setInterval(() => this.next(), 5000);
        },
        next() { this.current = (this.current + 1) % this.total; },
        prev() { this.current = (this.current - 1 + this.total) % this.total; },
        goTo(i) {
            this.current = i;
            clearInterval(this.timer);
            if (this.total > 1) this.timer = setInterval(() => this.next(), 5000);
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