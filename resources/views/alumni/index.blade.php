@extends('layouts.app')
@section('title', 'Alumni – TPQ Al-Mukharijin')

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
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-px w-16"
                        style="background:linear-gradient(to right,transparent,rgba(217,119,6,0.6))"></div>
                    <span class="text-amber-400/70 text-[11px] font-bold uppercase tracking-[0.25em]">
                        Generasi Qurani
                    </span>
                </div>
                <h1 class="font-extrabold text-white leading-tight mb-4"
                    style="font-size:clamp(2rem,5vw,3.5rem);">
                    Alumni<br>
                    <span style="background:linear-gradient(90deg,#fcd34d,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        TPQ Al-Mukharijin
                    </span>
                </h1>
                <p class="text-white/50 text-base leading-relaxed mb-8">
                    Mereka yang telah menyelesaikan pendidikan Al-Quran di TPQ Al-Mukharijin
                    dan kini menjadi generasi Qurani yang bermanfaat bagi masyarakat.
                </p>
                <div class="flex gap-8">
                    <div>
                        <p class="text-3xl font-extrabold text-white">{{ $totalAlumni }}+</p>
                        <p class="text-white/40 text-xs mt-1">Total Alumni</p>
                    </div>
                    <div class="w-px bg-white/10"></div>
                    <div>
                        <p class="text-3xl font-extrabold text-amber-300">{{ $totalAngkatan }}</p>
                        <p class="text-white/40 text-xs mt-1">Angkatan</p>
                    </div>
                    <div class="w-px bg-white/10"></div>
                    <div>
                        <p class="text-3xl font-extrabold text-emerald-300">{{ $angkatanPertama }}</p>
                        <p class="text-white/40 text-xs mt-1">Angkatan Pertama</p>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="relative p-8 rounded-3xl"
                    style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);">
                    <p class="font-arabic text-amber-300 text-3xl leading-loose mb-3 text-center">
                        طَلَبُ الْعِلْمِ فَرِيضَةٌ عَلَى كُلِّ مُسْلِمٍ
                    </p>
                    <p class="text-white/30 text-sm text-center italic">
                        "Menuntut ilmu adalah kewajiban bagi setiap muslim."
                    </p>
                    <div class="mt-6 flex items-center justify-center gap-3">
                        <div class="h-px flex-1 bg-white/10"></div>
                        <span class="text-white/20 text-xs">HR. Ibnu Majah</span>
                        <div class="h-px flex-1 bg-white/10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ FILTER & SEARCH ═══ --}}
<section class="py-16 bg-[#fafaf9]" x-data="alumniData()">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 mb-10">
            <div>
                <span class="section-label mb-2 block">Daftar Lengkap</span>
                <h2 class="font-extrabold text-stone-900 text-2xl">Semua Alumni</h2>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-stone-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input x-model="search" type="text" placeholder="Cari nama alumni..."
                        class="pl-9 pr-4 py-2.5 text-sm border border-stone-200 rounded-xl bg-white text-stone-700 placeholder-stone-400 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all w-full sm:w-56">
                </div>

                <select x-model="angkatan"
                    class="px-4 py-2.5 text-sm border border-stone-200 rounded-xl bg-white text-stone-700 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
                    <option value="semua">Semua Angkatan</option>
                    @foreach($angkatanList as $thn)
                    <option value="{{ $thn }}">Angkatan {{ $thn }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <p class="text-stone-400 text-sm mb-6">
            Menampilkan <span class="font-semibold text-stone-700" x-text="filtered.length"></span> alumni
            <span x-show="search !== ''" class="text-emerald-600">
                untuk "<span x-text="search"></span>"
            </span>
        </p>

        <div x-show="filtered.length > 0">
            <template x-for="thn in [...new Set(filtered.map(r => r.tahun))].sort((a,b) => b-a)" :key="thn">
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="shrink-0 px-4 py-1.5 rounded-full text-xs font-bold text-white"
                            style="background:linear-gradient(135deg,#064e3b,#065f46);">
                            Angkatan <span x-text="thn"></span>
                        </div>
                        <div class="flex-1 h-px bg-stone-100"></div>
                        <span class="text-stone-400 text-xs"
                            x-text="filtered.filter(r => r.tahun === thn).length + ' alumni'">
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        <template x-for="(row, i) in filtered.filter(r => r.tahun === thn)" :key="i">
                            <div class="bg-white rounded-2xl border border-stone-100 p-5 text-center hover:border-emerald-200 hover:shadow-md transition-all group">
                                <div class="w-14 h-14 rounded-2xl mx-auto mb-3 flex items-center justify-center text-lg font-extrabold text-white"
                                    style="background:linear-gradient(135deg,#064e3b,#10b981);">
                                    <span x-text="row.nama.charAt(0).toUpperCase()"></span>
                                </div>
                                <p class="font-bold text-stone-900 text-sm leading-snug line-clamp-2 group-hover:text-emerald-800 transition-colors"
                                    x-text="row.nama"></p>
                                <p class="text-stone-400 text-[10px] mt-1.5 font-medium"
                                    x-text="'Angkatan ' + row.tahun"></p>
                                <template x-if="row.keterangan">
                                    <p class="text-stone-400 text-[10px] mt-1 line-clamp-2 leading-relaxed"
                                        x-text="row.keterangan"></p>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="filtered.length === 0" class="text-center py-20 border-2 border-dashed border-stone-200 rounded-3xl">
            <svg class="w-12 h-12 text-stone-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-stone-400 text-sm">Tidak ada alumni ditemukan.</p>
            <button @click="search='';angkatan='semua'"
                class="mt-3 text-xs text-emerald-600 hover:underline font-medium">
                Reset pencarian
            </button>
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section class="py-16 bg-white border-t border-stone-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="rounded-3xl p-10 relative overflow-hidden"
            style="background:linear-gradient(135deg,#022c22,#064e3b);">
            <div class="pattern-bg absolute inset-0 opacity-20"></div>
            <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <p class="text-amber-300 text-xs font-bold uppercase tracking-widest mb-2">Untuk Para Alumni</p>
                    <h3 class="font-extrabold text-white text-xl md:text-2xl mb-2">
                        Ingin Data Anda Diperbarui?
                    </h3>
                    <p class="text-white/50 text-sm max-w-md">
                        Hubungi kami jika ada perubahan data atau ingin menambahkan
                        informasi alumni yang belum tercatat.
                    </p>
                </div>
                <a href="{{ route('profil.index') }}#lokasi"
                    style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);color:white;font-size:13px;font-weight:600;padding:12px 24px;border-radius:100px;transition:all 0.25s;text-decoration:none;white-space:nowrap;flex-shrink:0;"
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
function alumniData() {
    return {
        search: '',
        angkatan: 'semua',
        rows: @json($alumni->map(fn($a) => [
            'nama' => $a->nama,
            'tahun' => (int) $a->tahun_angkatan,
            'keterangan' => $a->keterangan ?? ''
        ])),
        get filtered() {
            return this.rows.filter(r => {
                const matchSearch = this.search === '' ||
                    r.nama.toLowerCase().includes(this.search.toLowerCase());
                const matchAngkatan = this.angkatan === 'semua' ||
                    String(r.tahun) === this.angkatan;
                return matchSearch && matchAngkatan;
            });
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