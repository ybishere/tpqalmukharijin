@extends('layouts.app')

@section('title', 'Program Donasi — TPQ Al-Mukharijin')

@section('content')

    {{-- HEADER --}}
    <section class="bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white">
        <div class="max-w-5xl mx-auto px-4 py-12 text-center">
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Program Donasi</h1>
            <p class="text-green-100 text-sm max-w-md mx-auto">Pilih program kebutuhan TPQ yang ingin Anda dukung. Setiap donasi tercatat transparan.</p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-10">

        {{-- FILTER --}}
        <div class="flex gap-2 mb-8">
            <a href="?status=aktif"
                class="text-xs px-4 py-2 rounded-full font-medium transition
                {{ request('status', 'aktif') == 'aktif' ? 'bg-green-600 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-green-400' }}">
                Aktif
            </a>
            <a href="?status=selesai"
                class="text-xs px-4 py-2 rounded-full font-medium transition
                {{ request('status') == 'selesai' ? 'bg-green-600 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-green-400' }}">
                Selesai
            </a>
            <a href="?status=semua"
                class="text-xs px-4 py-2 rounded-full font-medium transition
                {{ request('status') == 'semua' ? 'bg-green-600 text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-600 hover:border-green-400' }}">
                Semua
            </a>
        </div>

        {{-- GRID PROGRAM --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($programs as $program)
            @php
                $persen = $program->target_dana > 0
                    ? min(100, round(($program->dana_terkumpul / $program->target_dana) * 100))
                    : 0;
                $sisaDana = max(0, $program->target_dana - $program->dana_terkumpul);
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">

                {{-- FOTO --}}
                <div class="h-40 bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center overflow-hidden relative">
                    @if($program->foto)
                        <img src="{{ asset('storage/' . $program->foto) }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="{{ $program->nama_program }}">
                    @else
                        <div class="text-center">
                            <div class="text-5xl mb-1">🕌</div>
                            <div class="text-xs text-green-600 font-medium">TPQ Al-Mukharijin</div>
                        </div>
                    @endif
                    {{-- Badge status --}}
                    <div class="absolute top-3 right-3">
                        <span class="text-xs px-2.5 py-1 rounded-full font-medium shadow-sm
                            {{ $program->status == 'aktif' ? 'bg-green-600 text-white' : 'bg-gray-500 text-white' }}">
                            {{ ucfirst($program->status) }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="font-bold text-gray-800 text-sm mb-1.5 leading-snug">{{ $program->nama_program }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mb-4">{{ Str::limit($program->deskripsi, 90) }}</p>

                    {{-- Progress --}}
                    <div class="mb-1">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="text-gray-500">Terkumpul</span>
                            <span class="font-semibold text-green-600">{{ $persen }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-400 h-2 rounded-full transition-all duration-500"
                                style="width: {{ $persen }}%"></div>
                        </div>
                    </div>

                    {{-- Dana info --}}
                    <div class="flex justify-between text-xs mt-2 mb-4">
                        <div>
                            <div class="font-bold text-gray-800">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</div>
                            <div class="text-gray-400">terkumpul</div>
                        </div>
                        <div class="text-right">
                            <div class="font-medium text-gray-600">Rp {{ number_format($program->target_dana, 0, ',', '.') }}</div>
                            <div class="text-gray-400">target</div>
                        </div>
                    </div>

                    <a href="{{ route('program.detail', $program->id_program) }}"
                        class="block text-center bg-green-600 hover:bg-green-700 text-white text-xs font-semibold py-2.5 rounded-xl transition">
                        Lihat Detail & Donasi →
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center text-gray-400 py-16 text-sm">
                Tidak ada program untuk kategori ini.
            </div>
            @endforelse
        </div>

    </section>

@endsection