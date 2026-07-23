@extends('layouts.app')

@section('title', 'Laporan Transparansi — TPQ Al-Mukharijin')

@section('content')

    {{-- HEADER --}}
    <section class="bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white">
        <div class="max-w-5xl mx-auto px-4 py-12 text-center">
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Laporan Transparansi</h1>
            <p class="text-green-100 text-sm max-w-md mx-auto">Seluruh donasi dan penggunaan dana TPQ Al-Mukharijin tercatat secara terbuka dan bisa dipantau siapa saja.</p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-10">

        {{-- RINGKASAN --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="text-lg md:text-xl font-bold text-green-600">
                    Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-500 mt-1">Total donasi masuk</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="text-lg md:text-xl font-bold text-red-500">
                    Rp {{ number_format($totalPenggunaan, 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-500 mt-1">Total digunakan</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                @php $saldo = $totalDonasi - $totalPenggunaan; @endphp
                <div class="text-lg md:text-xl font-bold text-blue-600">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-500 mt-1">Saldo tersedia</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                <div class="text-lg md:text-xl font-bold text-amber-600">{{ $totalDonatur }}</div>
                <div class="text-xs text-gray-500 mt-1">Total donatur</div>
            </div>
        </div>

        {{-- TABEL DONASI MASUK --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-bold text-gray-800">Donasi Masuk</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Riwayat donasi yang telah terkonfirmasi</p>
                </div>
                <span class="text-xs bg-green-100 text-green-700 font-medium px-3 py-1 rounded-full">
                    {{ $donasis->count() }} transaksi
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="text-left px-5 py-3 font-semibold">Donatur</th>
                            <th class="text-left px-5 py-3 font-semibold">Program</th>
                            <th class="text-left px-5 py-3 font-semibold">Metode</th>
                            <th class="text-right px-5 py-3 font-semibold">Jumlah</th>
                            <th class="text-left px-5 py-3 font-semibold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($donasis as $donasi)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700 flex-shrink-0">
                                        {{ strtoupper(substr($donasi->nama_donatur, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $donasi->nama_donatur }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ Str::limit($donasi->program->nama_program, 30) }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2.5 py-1 rounded-full font-medium
                                    {{ $donasi->metode == 'qris' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ strtoupper($donasi->metode) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right font-bold text-green-600">
                                Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3 text-gray-400">
                                {{ $donasi->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-gray-400">
                                <div class="text-3xl mb-2">📋</div>
                                Belum ada donasi masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CARD PENGGUNAAN DANA --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-gray-800">Penggunaan Dana</h2>
            <p class="text-xs text-gray-400 mt-0.5">Catatan realisasi pengeluaran dana donasi</p>
        </div>
        <span class="text-xs bg-red-100 text-red-600 font-medium px-3 py-1 rounded-full">
            {{ $penggunaans->count() }} catatan
        </span>
    </div>

    <div class="p-5">
        @forelse($penggunaans as $penggunaan)
        <div class="card p-0 overflow-hidden mb-4 last:mb-0 fade-up">
            <div class="grid md:grid-cols-3 gap-0">

                {{-- Foto bukti --}}
                @if($penggunaan->bukti_foto)
                <div class="md:col-span-1 bg-stone-100 relative">
                    <a href="{{ asset('storage/' . $penggunaan->bukti_foto) }}" target="_blank">
                        <img src="{{ asset('storage/' . $penggunaan->bukti_foto) }}"
                            alt="Bukti {{ $penggunaan->uraian }}"
                            class="w-full h-48 md:h-full object-cover hover:opacity-90 transition-opacity">
                        <div class="absolute bottom-2 right-2 bg-black/50 text-white text-[10px] font-semibold px-2 py-1 rounded-lg">
                            🔍 Lihat Bukti
                        </div>
                    </a>
                </div>
                @else
                <div class="md:col-span-1 bg-stone-50 flex items-center justify-center h-48 md:h-auto">
                    <div class="text-center">
                        <svg class="w-10 h-10 text-stone-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-xs text-stone-400">Tidak ada foto bukti</p>
                    </div>
                </div>
                @endif

                {{-- Detail --}}
                <div class="md:col-span-2 p-6 flex flex-col justify-between">
                    <div>
                        {{-- Program --}}
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">
                            {{ $penggunaan->program->nama_program ?? 'Umum' }}
                        </span>

                        {{-- Uraian --}}
                        <h3 class="font-extrabold text-stone-900 text-base leading-snug mt-1 mb-3">
                            {{ $penggunaan->uraian }}
                        </h3>

                        {{-- Jumlah --}}
                        <div class="inline-flex items-center gap-2 bg-red-50 border border-red-100 rounded-xl px-4 py-2 mb-4">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="font-extrabold text-red-600 text-sm">
                                Rp {{ number_format($penggunaan->jumlah, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Keterangan jika ada --}}
                        @if($penggunaan->keterangan ?? null)
                        <p class="text-stone-500 text-xs leading-relaxed mb-3">
                            {{ $penggunaan->keterangan }}
                        </p>
                        @endif
                    </div>

                    {{-- Footer card --}}
                    <div class="flex items-center justify-between pt-3 border-t border-stone-100">
                        <div class="flex items-center gap-1.5 text-stone-400 text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $penggunaan->created_at->translatedFormat('d F Y') }}
                        </div>

                        @if($penggunaan->bukti_foto)
                        <a href="{{ asset('storage/' . $penggunaan->bukti_foto) }}"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 hover:text-emerald-800 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Lihat Bukti Lengkap
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <div class="text-4xl mb-3">📊</div>
            <p class="text-sm">Belum ada catatan penggunaan dana.</p>
        </div>
        @endforelse
    </div>
</div>

        {{-- CATATAN TRANSPARANSI --}}
        <div class="mt-8 bg-green-50 rounded-2xl p-6 flex gap-4 items-start">
            <div class="text-2xl flex-shrink-0">🔒</div>
            <div>
                <div class="text-sm font-bold text-gray-800 mb-1">Komitmen Transparansi</div>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Seluruh data donasi dan penggunaan dana di halaman ini adalah data nyata yang dikelola oleh pengurus TPQ Al-Mukharijin.
                    Laporan diperbarui secara berkala. Jika ada pertanyaan, silakan hubungi pengurus TPQ secara langsung.
                </p>
            </div>
        </div>

    </section>

@endsection