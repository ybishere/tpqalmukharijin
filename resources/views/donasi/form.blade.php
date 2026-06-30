@extends('layouts.app')

@section('title', 'Donasi — ' . $program->nama_program)

@section('content')
<section class="max-w-3xl mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <div class="text-xs text-gray-400 mb-6 flex items-center gap-2">
        <a href="{{ route('beranda') }}" class="hover:text-green-600">Beranda</a>
        <span>/</span>
        <a href="{{ route('program.index') }}" class="hover:text-green-600">Program</a>
        <span>/</span>
        <a href="{{ route('program.detail', $program->id_program) }}" class="hover:text-green-600">{{ $program->nama_program }}</a>
        <span>/</span>
        <span class="text-gray-600">Donasi</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- KIRI: FORM --}}
        <div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-green-600 via-yellow-400 to-green-600"></div>
                <div class="p-6">
                    <h2 class="font-bold text-gray-800 mb-1">Form Donasi</h2>
                    <p class="text-xs text-gray-400 mb-5">Isi data donasi Anda. Nominal bebas sesuai kemampuan.</p>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600">
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('donasi.store', $program->id_program) }}" class="space-y-4">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Donatur</label>
                            <input type="text" name="nama_donatur" value="{{ old('nama_donatur') }}"
                                placeholder="Kosongkan jika ingin anonim"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>

                        {{-- Nominal --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nominal Donasi <span class="text-red-500">*</span></label>
                            {{-- Pilihan cepat --}}
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                @foreach ([10000, 25000, 50000, 100000, 250000, 500000] as $nominal)
                                <button type="button" onclick="setNominal({{ $nominal }})"
                                    class="nominal-btn border border-gray-200 rounded-xl py-2 text-xs font-semibold text-gray-600 hover:border-green-500 hover:text-green-600 hover:bg-green-50 transition">
                                    Rp {{ number_format($nominal, 0, ',', '.') }}
                                </button>
                                @endforeach
                            </div>
                            <input type="number" name="jumlah" id="inputJumlah" value="{{ old('jumlah') }}"
                                placeholder="Atau ketik nominal lain..."
                                min="1000"
                                class="w-full border {{ $errors->has('jumlah') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            @error('jumlah')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Metode --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Metode Pembayaran</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="metode-label cursor-pointer">
                                    <input type="radio" name="metode" value="qris" class="sr-only" {{ old('metode', 'qris') == 'qris' ? 'checked' : '' }}>
                                    <div class="metode-card border-2 rounded-xl p-3 text-center transition
                                        {{ old('metode', 'qris') == 'qris' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                                        <div class="text-2xl mb-1">📱</div>
                                        <p class="text-xs font-semibold text-gray-700">QRIS</p>
                                        <p class="text-[10px] text-gray-400">GoPay, Dana, OVO, dll</p>
                                    </div>
                                </label>
                                <label class="metode-label cursor-pointer">
                                    <input type="radio" name="metode" value="manual" class="sr-only" {{ old('metode') == 'manual' ? 'checked' : '' }}>
                                    <div class="metode-card border-2 rounded-xl p-3 text-center transition
                                        {{ old('metode') == 'manual' ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                                        <div class="text-2xl mb-1">🏦</div>
                                        <p class="text-xs font-semibold text-gray-700">Transfer Bank</p>
                                        <p class="text-[10px] text-gray-400">ATM / m-banking</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Catatan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Doa / Pesan <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <textarea name="catatan" rows="2" placeholder="Semoga bermanfaat..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition resize-none">{{ old('catatan') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl text-sm transition shadow-sm">
                            Lanjutkan Donasi →
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- KANAN: INFO --}}
        <div class="flex flex-col gap-4">

            {{-- Info Program --}}
            <div class="bg-green-50 rounded-2xl p-5 border border-green-100">
                @if ($program->foto)
                    <img src="{{ Storage::url($program->foto) }}" class="w-full h-32 object-cover rounded-xl mb-3">
                @endif
                <p class="text-xs text-green-600 font-semibold mb-1">Program yang didukung</p>
                <p class="font-bold text-gray-800 text-sm">{{ $program->nama_program }}</p>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ Str::limit($program->deskripsi, 100) }}</p>
                <div class="mt-3">
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-500">Terkumpul</span>
                        <span class="font-bold text-green-600">{{ $persen }}%</span>
                    </div>
                    <div class="w-full bg-green-100 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $persen }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs mt-1">
                        <span class="text-green-700 font-semibold">Rp {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</span>
                        <span class="text-gray-400">dari Rp {{ number_format($program->target_dana, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Info Pembayaran --}}
            <div id="info-qris" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-700 mb-3">📱 Cara Bayar via QRIS</p>
                <div class="space-y-2">
                    @foreach([
                        'Klik Lanjutkan Donasi',
                        'Tunjukkan QR Code ke kasir atau scan sendiri',
                        'Konfirmasi via WhatsApp jika sudah bayar',
                        'Admin akan memverifikasi dalam 1x24 jam'
                    ] as $i => $step)
                    <div class="flex items-start gap-2">
                        <span class="w-5 h-5 rounded-full bg-green-600 text-white text-[10px] font-bold flex items-center justify-center flex-shrink-0">{{ $i+1 }}</span>
                        <p class="text-xs text-gray-600">{{ $step }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div id="info-manual" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hidden">
                <p class="text-xs font-semibold text-gray-700 mb-3">🏦 Info Rekening Transfer</p>
                <div class="bg-gray-50 rounded-xl p-3 mb-3">
                    <p class="text-xs text-gray-400 mb-0.5">Bank</p>
                    <p class="font-bold text-sm text-gray-800">— (Segera hadir)</p>
                </div>
                <p class="text-xs text-gray-400">Setelah transfer, konfirmasi ke admin via WhatsApp dengan bukti transfer.</p>
            </div>

            {{-- WhatsApp --}}
            <a href="https://wa.me/6281234567890?text=Assalamualaikum, saya ingin konfirmasi donasi untuk program {{ urlencode($program->nama_program) }}"
                target="_blank"
                class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold py-3 rounded-2xl transition shadow-sm">
                💬 Konfirmasi via WhatsApp
            </a>

        </div>
    </div>
</section>

<script>
function setNominal(val) {
    document.getElementById('inputJumlah').value = val;
    document.querySelectorAll('.nominal-btn').forEach(b => {
        b.classList.toggle('border-green-500', parseInt(b.textContent.replace(/\D/g,'').replace(',','')) === val || b.textContent.includes(new Intl.NumberFormat('id').format(val)));
        b.classList.toggle('text-green-600', parseInt(b.textContent.replace(/\D/g,'').replace(',','')) === val);
        b.classList.toggle('bg-green-50', parseInt(b.textContent.replace(/\D/g,'').replace(',','')) === val);
    });
}

// Toggle info pembayaran berdasarkan metode
document.querySelectorAll('input[name="metode"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('info-qris').classList.toggle('hidden', this.value !== 'qris');
        document.getElementById('info-manual').classList.toggle('hidden', this.value !== 'manual');

        document.querySelectorAll('.metode-card').forEach(card => {
            card.classList.remove('border-green-500', 'bg-green-50');
            card.classList.add('border-gray-200');
        });
        this.closest('.metode-label').querySelector('.metode-card').classList.add('border-green-500', 'bg-green-50');
        this.closest('.metode-label').querySelector('.metode-card').classList.remove('border-gray-200');
    });
});
</script>
@endsection