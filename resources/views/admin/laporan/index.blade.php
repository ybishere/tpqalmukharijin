@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('page_title', 'Laporan Keuangan')

@section('breadcrumb')
    <span class="text-emerald-600">Home</span> <span>/</span> <span>Laporan</span>
@endsection

@section('content')

{{-- Summary Cards --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Donasi</p>
        <p class="text-xl font-extrabold text-emerald-600">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $totalDonatur }} transaksi</p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Penggunaan</p>
        <p class="text-xl font-extrabold text-purple-600">Rp {{ number_format($totalPenggunaan, 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-1">{{ $penggunaans->count() }} transaksi</p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Sisa Dana</p>
        <p class="text-xl font-extrabold {{ $sisaDana >= 0 ? 'text-blue-600' : 'text-red-500' }}">
            Rp {{ number_format($sisaDana, 0, ',', '.') }}
        </p>
    </div>
    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Total Donatur</p>
        <p class="text-xl font-extrabold text-amber-500">{{ $totalDonatur }}</p>
        <p class="text-xs text-gray-400 mt-1">orang berdonasi</p>
    </div>
</div>

{{-- Filter --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-5 p-4">
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="min-w-[120px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Tahun</label>
            <select name="tahun" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                @foreach (range(date('Y'), 2024) as $y)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <div class="min-w-[130px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Bulan</label>
            <select name="bulan" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                <option value="">Semua Bulan</option>
                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
                    <option value="{{ $i+1 }}" {{ $bulan == $i+1 ? 'selected' : '' }}>{{ $bln }}</option>
                @endforeach
            </select>
        </div>
        <div class="min-w-[180px]">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Program</label>
            <select name="program_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                <option value="">Semua Program</option>
                @foreach ($programs as $p)
                    <option value="{{ $p->id_program }}" {{ $program_id == $p->id_program ? 'selected' : '' }}>
                        {{ $p->nama_program }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
            Tampilkan
        </button>
        @if(request()->hasAny(['bulan','program_id']))
            <a href="{{ route('admin.laporan.index', ['tahun' => $tahun]) }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                Reset
            </a>
        @endif
    </form>
</div>

<div class="flex gap-2 ml-auto">
    <a href="{{ route('admin.laporan.export.excel', request()->query()) }}"
        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Excel
    </a>
    <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}"
        class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        PDF
    </a>
</div>

{{-- Chart Donasi Per Bulan --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-5">
    <h3 class="font-bold text-gray-800 mb-4">Grafik Donasi {{ $tahun }}</h3>
    <div class="relative h-48">
        <canvas id="chartDonasi"></canvas>
    </div>
</div>

{{-- Tabel Donasi --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-5">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-gray-800">Rincian Donasi</h3>
        <span class="text-xs text-gray-400">{{ $donasis->count() }} data</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Donatur</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Program</th>
                    <th class="text-right text-xs font-semibold text-gray-500 px-5 py-3">Jumlah</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Metode</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($donasis as $d)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $d->nama_donatur }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $d->program->nama_program ?? '-' }}</td>
                    <td class="px-5 py-3 text-right font-semibold text-emerald-600">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        <span class="text-xs font-semibold uppercase {{ $d->metode === 'qris' ? 'text-purple-600' : 'text-blue-600' }}">
                            {{ $d->metode }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $d->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada data donasi</td></tr>
                @endforelse
            </tbody>
            @if ($donasis->count())
            <tfoot class="bg-emerald-50 border-t border-emerald-100">
                <tr>
                    <td colspan="2" class="px-5 py-3 text-sm font-bold text-emerald-800">Total</td>
                    <td class="px-5 py-3 text-right font-extrabold text-emerald-700">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

{{-- Tabel Penggunaan --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-gray-800">Rincian Penggunaan Dana</h3>
        <span class="text-xs text-gray-400">{{ $penggunaans->count() }} data</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Uraian</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Program</th>
                    <th class="text-right text-xs font-semibold text-gray-500 px-5 py-3">Jumlah</th>
                    <th class="text-left text-xs font-semibold text-gray-500 px-5 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($penggunaans as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 text-gray-800 max-w-[240px]">{{ Str::limit($p->uraian, 60) }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $p->program->nama_program ?? '-' }}</td>
                    <td class="px-5 py-3 text-right font-semibold text-purple-600">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $p->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada data penggunaan</td></tr>
                @endforelse
            </tbody>
            @if ($penggunaans->count())
            <tfoot class="bg-purple-50 border-t border-purple-100">
                <tr>
                    <td colspan="2" class="px-5 py-3 text-sm font-bold text-purple-800">Total</td>
                    <td class="px-5 py-3 text-right font-extrabold text-purple-700">Rp {{ number_format($totalPenggunaan, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
    const donasiData = @json($donasiPerBulan);

    const data = bulanLabel.map((_, i) => donasiData[i + 1] ?? 0);

    new Chart(document.getElementById('chartDonasi'), {
        type: 'bar',
        data: {
            labels: bulanLabel,
            datasets: [{
                label: 'Donasi (Rp)',
                data: data,
                backgroundColor: 'rgba(16, 185, 129, 0.15)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 2,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v),
                        font: { size: 10 }
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });
</script>
@endpush