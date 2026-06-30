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

        {{-- TABEL PENGGUNAAN DANA --}}
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
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="text-left px-5 py-3 font-semibold">Uraian</th>
                            <th class="text-left px-5 py-3 font-semibold">Program</th>
                            <th class="text-right px-5 py-3 font-semibold">Jumlah</th>
                            <th class="text-left px-5 py-3 font-semibold">Bukti</th>
                            <th class="text-left px-5 py-3 font-semibold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($penggunaans as $penggunaan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3 text-gray-700 font-medium">{{ $penggunaan->uraian }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ Str::limit($penggunaan->program->nama_program, 30) }}</td>
                            <td class="px-5 py-3 text-right font-bold text-red-500">
                                Rp {{ number_format($penggunaan->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                @if($penggunaan->bukti_foto)
                                    <a href="{{ asset('storage/' . $penggunaan->bukti_foto) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 font-medium transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        Lihat bukti
                                    </a>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-400">
                                {{ $penggunaan->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-gray-400">
                                <div class="text-3xl mb-2">📊</div>
                                Belum ada catatan penggunaan dana.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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