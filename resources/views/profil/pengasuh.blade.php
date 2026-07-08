@extends('layouts.app')
@section('title', 'Pengasuh & Pengajar – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative pt-32 pb-20 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 40%,#064e3b 100%);">
    <div class="pattern-bg absolute inset-0 opacity-30"></div>
    <div class="absolute top-0 right-0 w-96 h-96"
        style="background:radial-gradient(circle,rgba(16,185,129,0.06) 0%,transparent 70%)"></div>
    <div class="absolute top-0 left-0 right-0 h-px"
        style="background:linear-gradient(90deg,transparent,rgba(245,158,11,0.4),transparent)"></div>

    <div class="relative max-w-6xl mx-auto px-6">
        <div class="max-w-2xl">
            <div class="flex items-center gap-4 mb-6">
                <div class="h-px w-16" style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.6))"></div>
                <span class="text-amber-400/70 text-[11px] font-bold uppercase tracking-[0.25em]">Tim Pengajar</span>
            </div>
            <h1 class="font-extrabold text-white leading-tight mb-4"
                style="font-size:clamp(2rem,5vw,3.5rem);">
                Pengasuh &<br>
                <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Pengajar</span>
            </h1>
            <p class="text-white/50 text-base leading-relaxed">
                Mengenal sosok-sosok berdedikasi yang setiap hari hadir membimbing
                santri TPQ Al-Mukharijin dengan penuh keikhlasan dan kasih sayang.
            </p>
        </div>
    </div>
</section>

{{-- ═══ FILTER TAB ═══ --}}
<div class="sticky top-16 z-40 bg-white border-b border-stone-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex gap-1 py-2" x-data="{ tab: 'semua' }">
            @foreach(['semua' => 'Semua', 'Pengasuh' => 'Pengasuh', 'Pengajar' => 'Pengajar'] as $val => $label)
            <button
                @click="tab = '{{ $val }}'; filterKartu('{{ $val }}')"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-all"
                :class="tab === '{{ $val }}'
                    ? 'bg-emerald-50 text-emerald-800 font-semibold'
                    : 'text-stone-500 hover:text-stone-800 hover:bg-stone-50'">
                {{ $label }}
                @if($val === 'semua')
                    <span class="ml-1.5 text-xs text-stone-400">({{ $founders->count() }})</span>
                @elseif($val === 'Pengasuh')
                    <span class="ml-1.5 text-xs text-stone-400">({{ $founders->where('status','Pengasuh')->count() }})</span>
                @else
                    <span class="ml-1.5 text-xs text-stone-400">({{ $founders->where('status','Pengajar')->count() }})</span>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══ GRID KARTU ═══ --}}
<section class="py-20 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Pengasuh — tampil besar --}}
        @php $pengasuh = $founders->where('status','Pengasuh'); @endphp
        @if($pengasuh->count())
        <div class="mb-16 founder-group" data-status="Pengasuh">
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px w-8 bg-amber-400"></div>
                <span class="text-amber-600 text-[11px] font-bold uppercase tracking-[0.2em]">Pengasuh</span>
                <div class="flex-1 h-px bg-stone-100"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                @foreach($pengasuh as $p)
                <div class="fade-up founder-card" data-status="{{ $p->status }}">
                    <div class="card p-8 flex gap-6 items-start group">

                        {{-- Foto --}}
                        <div class="shrink-0 relative">
                            @if($p->foto)
                                <img src="{{ Storage::url($p->foto) }}" alt="{{ $p->nama }}"
                                    class="w-24 h-24 rounded-2xl object-cover"
                                    style="box-shadow:0 8px 24px rgba(6,78,59,0.15);">
                            @else
                                <div class="w-24 h-24 rounded-2xl flex items-center justify-center"
                                    style="background:linear-gradient(135deg,#064e3b,#065f46);box-shadow:0 8px 24px rgba(6,78,59,0.2);">
                                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Badge status --}}
                            <div class="absolute -bottom-2 -right-2 w-6 h-6 rounded-full border-2 border-white flex items-center justify-center"
                                style="background:#064e3b;">
                                <svg class="w-3 h-3 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <span style="background:linear-gradient(135deg,#fef3c7,#fde68a);color:#92400e;font-size:10px;font-weight:700;padding:3px 10px;border-radius:100px;border:1px solid rgba(180,83,9,0.15);">
                                {{ $p->jabatan }}
                            </span>
                            <h3 class="font-extrabold text-stone-900 text-lg mt-2 mb-1 group-hover:text-emerald-800 transition-colors">
                                {{ $p->nama }}
                            </h3>
                            @if($p->keterangan)
                            <p class="text-stone-500 text-sm leading-relaxed line-clamp-3">{{ $p->keterangan }}</p>
                            @endif

                            {{-- Quote --}}
                            @if($p->quotes)
                            <div class="mt-4 pt-4 border-t border-stone-100">
                                <p class="text-stone-400 text-xs italic leading-relaxed line-clamp-2">
                                    "{{ $p->quotes }}"
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Pengajar — grid 3 kolom --}}
        @php $pengajar = $founders->where('status','Pengajar'); @endphp
        @if($pengajar->count())
        <div class="founder-group" data-status="Pengajar">
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px w-8 bg-emerald-500"></div>
                <span class="text-emerald-700 text-[11px] font-bold uppercase tracking-[0.2em]">Pengajar</span>
                <div class="flex-1 h-px bg-stone-100"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pengajar as $p)
                <div class="fade-up founder-card" data-status="{{ $p->status }}">
                    <div class="card p-6 text-center group h-full flex flex-col">

                        {{-- Foto --}}
                        <div class="relative inline-block mx-auto mb-5">
                            @if($p->foto)
                                <img src="{{ Storage::url($p->foto) }}" alt="{{ $p->nama }}"
                                    class="w-20 h-20 rounded-2xl object-cover mx-auto"
                                    style="box-shadow:0 8px 20px rgba(0,0,0,0.1);">
                            @else
                                <div class="w-20 h-20 rounded-2xl mx-auto flex items-center justify-center"
                                    style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:1px solid rgba(16,185,129,0.2);">
                                    <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute -bottom-1.5 -right-1.5 w-5 h-5 rounded-full border-2 border-white flex items-center justify-center bg-emerald-500">
                                <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>

                        <span style="background:#f0fdf4;color:#15803d;font-size:10px;font-weight:700;padding:3px 10px;border-radius:100px;border:1px solid rgba(22,163,74,0.15);display:inline-block;margin-bottom:8px;">
                            {{ $p->jabatan }}
                        </span>
                        <h3 class="font-bold text-stone-900 mb-2 group-hover:text-emerald-800 transition-colors">
                            {{ $p->nama }}
                        </h3>
                        @if($p->keterangan)
                        <p class="text-stone-400 text-xs leading-relaxed line-clamp-3 flex-1">{{ $p->keterangan }}</p>
                        @endif

                        @if($p->quotes)
                        <div class="mt-4 pt-4 border-t border-stone-50">
                            <p class="text-stone-400 text-xs italic line-clamp-2">"{{ $p->quotes }}"</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($founders->isEmpty())
        <div class="text-center py-20 border-2 border-dashed border-stone-200 rounded-3xl">
            <p class="text-stone-400 text-sm">Belum ada data pengasuh & pengajar.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═══ CTA BERGABUNG ═══ --}}
<section class="py-16 bg-white border-t border-stone-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="rounded-3xl p-10 relative overflow-hidden"
            style="background:linear-gradient(135deg,#022c22,#064e3b);">
            <div class="pattern-bg absolute inset-0 opacity-20"></div>
            <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <p class="text-amber-300 text-xs font-bold uppercase tracking-widest mb-2">Bergabung Bersama Kami</p>
                    <h3 class="font-extrabold text-white text-xl md:text-2xl mb-2">
                        Ingin Mengabdi Mengajar Al-Quran?
                    </h3>
                    <p class="text-white/50 text-sm max-w-md">
                        TPQ Al-Mukharijin terbuka bagi siapa saja yang ingin berkontribusi
                        dalam pendidikan Al-Quran untuk generasi penerus.
                    </p>
                </div>
                <a href="{{ route('profil.index') }}#lokasi"
                    style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);color:white;font-size:13px;font-weight:600;padding:12px 24px;border-radius:100px;transition:all 0.25s;text-decoration:none;white-space:nowrap;backdrop-filter:blur(8px);flex-shrink:0;"
                    onmouseenter="this.style.background='rgba(255,255,255,0.2)'"
                    onmouseleave="this.style.background='rgba(255,255,255,0.12)'">
                    Hubungi Kami
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function filterKartu(status) {
    document.querySelectorAll('.founder-group').forEach(group => {
        if (status === 'semua') {
            group.style.display = 'block';
        } else {
            group.style.display = group.dataset.status === status ? 'block' : 'none';
        }
    });

    document.querySelectorAll('.founder-card').forEach(card => {
        if (status === 'semua' || card.dataset.status === status) {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }
    });
}

const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
</script>
@endpush