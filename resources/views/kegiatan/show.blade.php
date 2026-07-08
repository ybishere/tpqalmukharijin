@extends('layouts.app')
@section('title', $kegiatan->judul . ' – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative pt-32 pb-0 overflow-hidden"
    style="background:linear-gradient(135deg,#011a10 0%,#022c22 50%,#064e3b 100%);min-height:420px;">
    <div class="pattern-bg absolute inset-0 opacity-25"></div>

    @if($kegiatan->thumbnail)
    <div class="absolute inset-0">
        <img src="{{ Storage::url($kegiatan->thumbnail) }}" alt="{{ $kegiatan->judul }}"
            class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0" style="background:linear-gradient(to bottom,rgba(1,26,16,0.7) 0%,rgba(2,44,34,0.9) 100%)"></div>
    </div>
    @endif

    <div class="relative max-w-6xl mx-auto px-6 pb-16">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-white/40 text-xs mb-8">
            <a href="{{ route('beranda') }}" class="hover:text-white/70 transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('kegiatan.index') }}" class="hover:text-white/70 transition-colors">Kegiatan</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60 line-clamp-1">{{ $kegiatan->judul }}</span>
        </div>

        <div class="max-w-3xl">
            <span class="badge {{ $kegiatan->status === 'akan_datang' ? 'badge-amber' : 'badge-green' }} mb-5">
                {{ $kegiatan->status === 'akan_datang' ? '⏰ Akan Datang' : '✓ Selesai' }}
            </span>
            <h1 class="font-extrabold text-white leading-tight mb-5"
                style="font-size:clamp(1.8rem,4vw,3rem);">
                {{ $kegiatan->judul }}
            </h1>
            <div class="flex flex-wrap items-center gap-5 text-white/50 text-sm">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                </span>
                @if($kegiatan->photos && $kegiatan->photos->count() > 0)
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $kegiatan->photos->count() }} foto dokumentasi
                </span>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══ KONTEN ═══ --}}
<section class="py-16 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-3 gap-12">

            {{-- Kiri: Deskripsi --}}
            <div class="lg:col-span-2">
                @if($kegiatan->deskripsi)
                <div class="prose prose-stone max-w-none mb-10">
                    <p class="text-stone-600 text-base leading-relaxed">{{ $kegiatan->deskripsi }}</p>
                </div>
                @endif

                {{-- Album Foto --}}
                @if($kegiatan->photos && $kegiatan->photos->count() > 0)
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <h2 class="font-extrabold text-stone-900 text-lg">Album Foto</h2>
                        <div class="flex-1 h-px bg-stone-100"></div>
                        <span class="text-stone-400 text-xs">{{ $kegiatan->photos->count() }} foto</span>
                    </div>

                    {{-- Lightbox gallery --}}
                    <div x-data="gallery()" class="space-y-3">

                        {{-- Featured foto pertama --}}
                        @php $firstPhoto = $kegiatan->photos->first(); @endphp
                        <div class="relative overflow-hidden rounded-2xl cursor-pointer group"
                            style="aspect-ratio:16/9;"
                            @click="open(0)">
                            <img src="{{ Storage::url($firstPhoto->foto) }}"
                                alt="{{ $firstPhoto->keterangan ?? $kegiatan->judul }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                style="background:rgba(0,0,0,0.3);">
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </div>
                            @if($firstPhoto->keterangan)
                            <div class="absolute bottom-0 left-0 right-0 p-4"
                                style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent)">
                                <p class="text-white text-sm font-medium">{{ $firstPhoto->keterangan }}</p>
                            </div>
                            @endif
                        </div>

                        {{-- Grid foto lainnya --}}
                        @if($kegiatan->photos->count() > 1)
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-2">
                            @foreach($kegiatan->photos->skip(1) as $pi => $photo)
                            <div class="relative overflow-hidden rounded-xl cursor-pointer group"
                                style="aspect-ratio:1;"
                                @click="open({{ $pi + 1 }})">
                                <img src="{{ Storage::url($photo->foto) }}"
                                    alt="{{ $photo->keterangan ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                    style="background:rgba(0,0,0,0.35);">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Lightbox modal --}}
                        <div x-show="isOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @keydown.escape.window="isOpen=false"
                            @keydown.arrow-left.window="prev()"
                            @keydown.arrow-right.window="next()"
                            class="fixed inset-0 z-50 flex items-center justify-center p-4"
                            style="background:rgba(0,0,0,0.92);display:none;"
                            @click.self="isOpen=false">

                            {{-- Close --}}
                            <button @click="isOpen=false"
                                class="absolute top-4 right-4 w-10 h-10 rounded-full flex items-center justify-center text-white/70 hover:text-white transition-colors"
                                style="background:rgba(255,255,255,0.1);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>

                            {{-- Prev --}}
                            <button @click="prev()"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full flex items-center justify-center text-white/70 hover:text-white transition-all"
                                style="background:rgba(255,255,255,0.1);"
                                onmouseenter="this.style.background='rgba(255,255,255,0.2)'"
                                onmouseleave="this.style.background='rgba(255,255,255,0.1)'">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>

                            {{-- Image --}}
                            <div class="max-w-4xl w-full mx-12">
                                @foreach($kegiatan->photos as $pi => $photo)
                                <div x-show="current === {{ $pi }}"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100">
                                    <img src="{{ Storage::url($photo->foto) }}"
                                        alt="{{ $photo->keterangan ?? '' }}"
                                        class="w-full max-h-[75vh] object-contain rounded-2xl">
                                    @if($photo->keterangan)
                                    <p class="text-white/60 text-sm text-center mt-4">{{ $photo->keterangan }}</p>
                                    @endif
                                </div>
                                @endforeach
                                <p class="text-white/30 text-xs text-center mt-3">
                                    <span x-text="current + 1"></span> / {{ $kegiatan->photos->count() }}
                                </p>
                            </div>

                            {{-- Next --}}
                            <button @click="next()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full flex items-center justify-center text-white/70 hover:text-white transition-all"
                                style="background:rgba(255,255,255,0.1);"
                                onmouseenter="this.style.background='rgba(255,255,255,0.2)'"
                                onmouseleave="this.style.background='rgba(255,255,255,0.1)'">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-12 border-2 border-dashed border-stone-200 rounded-2xl">
                    <svg class="w-10 h-10 text-stone-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-stone-400 text-sm">Belum ada foto dokumentasi.</p>
                </div>
                @endif
            </div>

            {{-- Kanan: Sidebar --}}
            <div class="lg:col-span-1 space-y-5">

                {{-- Info card --}}
                <div class="bg-white rounded-2xl border border-stone-100 p-6 shadow-sm">
                    <h3 class="font-bold text-stone-900 text-sm mb-5">Informasi Kegiatan</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-0.5">Tanggal</p>
                                <p class="text-stone-700 text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg {{ $kegiatan->status === 'akan_datang' ? 'bg-amber-50' : 'bg-emerald-50' }} flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 {{ $kegiatan->status === 'akan_datang' ? 'text-amber-600' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-0.5">Status</p>
                                <span class="badge {{ $kegiatan->status === 'akan_datang' ? 'badge-amber' : 'badge-green' }}">
                                    {{ $kegiatan->status === 'akan_datang' ? 'Akan Datang' : 'Selesai' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kegiatan lainnya --}}
                @if($lainnya->count())
                <div class="bg-white rounded-2xl border border-stone-100 p-6 shadow-sm">
                    <h3 class="font-bold text-stone-900 text-sm mb-4">Kegiatan Lainnya</h3>
                    <div class="space-y-3">
                        @foreach($lainnya as $item)
                        <a href="{{ route('kegiatan.show', $item->id) }}"
                            class="flex gap-3 items-start group">
                            <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0">
                                @if($item->thumbnail)
                                    <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-stone-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-stone-900 text-xs font-semibold leading-snug line-clamp-2 group-hover:text-emerald-800 transition-colors">
                                    {{ $item->judul }}
                                </p>
                                <p class="text-stone-400 text-[10px] mt-1">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Tombol kembali --}}
                <a href="{{ route('kegiatan.index') }}"
                    class="flex items-center gap-2 text-sm font-semibold text-stone-500 hover:text-emerald-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Kegiatan
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function gallery() {
    return {
        isOpen: false,
        current: 0,
        total: {{ $kegiatan->photos->count() }},
        open(i) { this.current = i; this.isOpen = true; },
        prev() { this.current = (this.current - 1 + this.total) % this.total; },
        next() { this.current = (this.current + 1) % this.total; },
    }
}
</script>
@endpush