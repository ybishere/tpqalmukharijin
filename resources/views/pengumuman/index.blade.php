@extends('layouts.app')
@section('title', 'Pengumuman – TPQ Al-Mukharijin')

@section('content')

{{-- ═══ HERO ═══ --}}
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
                    Info & Berita
                </span>
            </div>
            <h1 class="font-extrabold text-white leading-tight mb-4"
                style="font-size:clamp(2rem,5vw,3.5rem);">
                Pengumuman<br>
                <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    & Berita
                </span>
            </h1>
            <p class="text-white/50 text-base leading-relaxed">
                Informasi terkini seputar jadwal, kegiatan mendatang,
                dan berita dari TPQ Al-Mukharijin.
            </p>
        </div>
    </div>
</section>

{{-- ═══ KONTEN ═══ --}}
<section class="py-20 bg-[#fafaf9]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-3 gap-10">

            {{-- Kiri: List pengumuman --}}
            <div class="lg:col-span-2">

                @if($pengumuman->count())

                {{-- Featured — pengumuman terbaru --}}
                @php $featured = $pengumuman->first(); @endphp
                <a href="{{ route('pengumuman.show', $featured->id) }}"
                    class="fade-up block card overflow-hidden group mb-6">
                    @if($featured->thumbnail)
                    <div class="relative overflow-hidden" style="aspect-ratio:16/7;">
                        <img src="{{ Storage::url($featured->thumbnail) }}" alt="{{ $featured->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0"
                            style="background:linear-gradient(to top,rgba(0,0,0,0.7) 0%,transparent 60%)"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="badge badge-amber mb-3">📢 Terbaru</span>
                            <h2 class="text-white font-extrabold text-xl leading-tight">{{ $featured->judul }}</h2>
                            <p class="text-white/60 text-sm mt-1">
                                {{ \Carbon\Carbon::parse($featured->tanggal_publish)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="p-7"
                        style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);border-bottom:1px solid rgba(16,185,129,0.1);">
                        <span class="badge badge-amber mb-4">📢 Terbaru</span>
                        <h2 class="font-extrabold text-stone-900 text-xl leading-tight mb-2 group-hover:text-emerald-800 transition-colors">
                            {{ $featured->judul }}
                        </h2>
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-2">
                            {{ Str::limit(strip_tags($featured->isi), 150) }}
                        </p>
                        <p class="text-stone-400 text-xs mt-3">
                            {{ \Carbon\Carbon::parse($featured->tanggal_publish)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    @endif
                    @if(!$featured->thumbnail)
                    @else
                    <div class="p-5">
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-2">
                            {{ Str::limit(strip_tags($featured->isi), 150) }}
                        </p>
                        <div class="mt-3 flex items-center gap-1.5 text-emerald-700 text-xs font-semibold">
                            Baca Selengkapnya
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                    @endif
                </a>

                {{-- List pengumuman lainnya --}}
                <div class="space-y-3">
                    @foreach($pengumuman->skip(1) as $i => $item)
                    <a href="{{ route('pengumuman.show', $item->id) }}"
                        class="fade-up announcement-row group">
                        {{-- Nomor --}}
                        <div class="shrink-0 w-11 h-11 rounded-xl flex items-center justify-center font-bold text-sm"
                            style="background:#f0fdf4;color:#15803d;min-width:44px;">
                            {{ str_pad($i + 2, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        {{-- Thumbnail kecil --}}
                        @if($item->thumbnail)
                        <div class="shrink-0 w-16 h-16 rounded-xl overflow-hidden">
                            <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}"
                                class="w-full h-full object-cover">
                        </div>
                        @endif

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-stone-400 text-[10px] mb-1">
                                {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}
                            </p>
                            <h3 class="font-bold text-stone-900 text-sm leading-snug line-clamp-1 group-hover:text-emerald-800 transition-colors">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-stone-400 text-xs mt-1 line-clamp-1">
                                {{ Str::limit(strip_tags($item->isi), 80) }}
                            </p>
                        </div>

                        <svg class="w-4 h-4 text-stone-300 group-hover:text-emerald-500 shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($pengumuman->hasPages())
                <div class="mt-10 flex items-center justify-center gap-2">
                    @if($pengumuman->onFirstPage())
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center text-stone-300 cursor-not-allowed border border-stone-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </span>
                    @else
                    <a href="{{ $pengumuman->previousPageUrl() }}"
                        class="w-10 h-10 rounded-xl flex items-center justify-center text-stone-600 border border-stone-200 hover:border-emerald-300 hover:text-emerald-700 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                    @endif

                    @foreach($pengumuman->getUrlRange(1, $pengumuman->lastPage()) as $page => $url)
                    @if($page == $pengumuman->currentPage())
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold text-white"
                        style="background:linear-gradient(135deg,#064e3b,#065f46);">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}"
                        class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-medium text-stone-600 border border-stone-200 hover:border-emerald-300 hover:text-emerald-700 transition-all">
                        {{ $page }}
                    </a>
                    @endif
                    @endforeach

                    @if($pengumuman->hasMorePages())
                    <a href="{{ $pengumuman->nextPageUrl() }}"
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
                    <p class="text-stone-400 text-sm">Belum ada pengumuman.</p>
                </div>
                @endif
            </div>

            {{-- Kanan: Sidebar --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Kalender --}}
                <div class="bg-white rounded-3xl border border-stone-100 overflow-hidden shadow-sm"
                    x-data="kalender()">
                    <div class="p-5"
                        style="background:linear-gradient(135deg,#064e3b,#065f46);">
                        <div class="flex items-center justify-between mb-3">
                            <button @click="prevMonth()"
                                class="w-8 h-8 rounded-xl flex items-center justify-center text-white/60 hover:text-white hover:bg-white/15 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <div class="text-center">
                                <p class="text-white font-bold text-sm" x-text="monthYearLabel"></p>
                                <p class="text-amber-300 text-xs mt-0.5 font-arabic" x-text="hijriLabel"></p>
                            </div>
                            <button @click="nextMonth()"
                                class="w-8 h-8 rounded-xl flex items-center justify-center text-white/60 hover:text-white hover:bg-white/15 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="grid grid-cols-7 mb-2">
                            <template x-for="d in ['Min','Sen','Sel','Rab','Kam','Jum','Sab']" :key="d">
                                <div class="text-center text-[10px] font-bold text-stone-400 uppercase py-1" x-text="d"></div>
                            </template>
                        </div>
                        <div class="grid grid-cols-7 gap-0.5">
                            <template x-for="n in startDay" :key="'e'+n">
                                <div></div>
                            </template>
                            <template x-for="day in daysInMonth" :key="day">
                                <button @click="selectDay(day)"
                                    class="relative aspect-square flex items-center justify-center text-xs rounded-xl transition-all font-medium"
                                    :class="{
                                        'text-white font-bold': isToday(day),
                                        'text-emerald-700 bg-emerald-50': isSelected(day) && !isToday(day),
                                        'text-stone-700 hover:bg-stone-100': !isToday(day) && !isSelected(day),
                                    }"
                                    :style="isToday(day) ? 'background:linear-gradient(135deg,#064e3b,#10b981);' : ''">
                                    <span x-text="day"></span>
                                    <template x-if="hasEvent(day)">
                                        <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-amber-400"></span>
                                    </template>
                                </button>
                            </template>
                        </div>

                        <div class="mt-4 pt-4 border-t border-stone-100">
                            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-1">Dipilih</p>
                            <p class="text-stone-800 font-bold text-sm" x-text="selectedMasehi"></p>
                            <p class="text-amber-600 text-xs font-arabic mt-0.5" x-text="selectedHijri"></p>
                        </div>

                        {{-- Agenda terdekat --}}
                        @if($agendaTerdekat)
                        <div class="mt-3 pt-3 border-t border-stone-100">
                            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wide mb-2">Agenda Terdekat</p>
                            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:10px 12px;">
                                <p class="text-emerald-800 font-bold text-xs leading-tight">{{ $agendaTerdekat->judul }}</p>
                                <p class="text-emerald-600 text-[10px] mt-1">
                                    {{ \Carbon\Carbon::parse($agendaTerdekat->tanggal_publish)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Kegiatan mendatang --}}
                @if($agendaAkanDatang->count())
                <div class="bg-white rounded-2xl border border-stone-100 p-5 shadow-sm">
                    <h3 class="font-bold text-stone-900 text-sm mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        Agenda Mendatang
                    </h3>
                    <div class="space-y-3">
                        @foreach($agendaAkanDatang as $agenda)
                        <div class="flex gap-3 items-start">
                            <div class="shrink-0 text-center"
                                style="background:#fef3c7;border-radius:10px;padding:6px 10px;min-width:44px;">
                                <p class="text-amber-700 font-extrabold text-base leading-none">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}
                                </p>
                                <p class="text-amber-600 text-[10px] font-semibold uppercase">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('M') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-stone-800 font-semibold text-xs leading-snug">{{ $agenda->judul }}</p>
                                <p class="text-stone-400 text-[10px] mt-0.5">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('l') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-hijri/2.1.2/moment-hijri.min.js"></script>
<script>
function kalender() {
    return {
        today: moment(),
        viewDate: moment(),
        selected: moment(),
        eventDates: @json($pengumumanDates),

        get monthYearLabel() {
            const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            return months[this.viewDate.month()] + ' ' + this.viewDate.year();
        },
        get hijriLabel() {
            try {
                const m = moment(this.viewDate.format('YYYY-MM') + '-01','YYYY-MM-DD');
                return m.format('iMMMM iYYYY H');
            } catch(e) { return ''; }
        },
        get daysInMonth() { return this.viewDate.daysInMonth(); },
        get startDay() { return moment(this.viewDate).startOf('month').day(); },
        get selectedMasehi() {
            const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            return days[this.selected.day()] + ', ' + this.selected.date() + ' ' + months[this.selected.month()] + ' ' + this.selected.year();
        },
        get selectedHijri() {
            try {
                const hijriMonths = ['Muharram','Safar','Rabi\'ul Awal','Rabi\'ul Akhir','Jumadil Awal','Jumadil Akhir','Rajab','Sya\'ban','Ramadhan','Syawal','Dzulqa\'dah','Dzulhijjah'];
                const m = moment(this.selected.format('YYYY-MM-DD'),'YYYY-MM-DD');
                return m.iDate() + ' ' + hijriMonths[m.iMonth()] + ' ' + m.iYear() + ' H';
            } catch(e) { return ''; }
        },
        isToday(day) {
            return this.today.date()===day && this.today.month()===this.viewDate.month() && this.today.year()===this.viewDate.year();
        },
        isSelected(day) {
            return this.selected.date()===day && this.selected.month()===this.viewDate.month() && this.selected.year()===this.viewDate.year();
        },
        hasEvent(day) {
            const d = this.viewDate.year()+'-'+String(this.viewDate.month()+1).padStart(2,'0')+'-'+String(day).padStart(2,'0');
            return this.eventDates.includes(d);
        },
        selectDay(day) { this.selected = moment(this.viewDate).date(day); },
        prevMonth() { this.viewDate = moment(this.viewDate).subtract(1,'month'); },
        nextMonth() { this.viewDate = moment(this.viewDate).add(1,'month'); },
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