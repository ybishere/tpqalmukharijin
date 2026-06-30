<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan TPQ Al-Mukharijin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1a1a1a; }

        .header { text-align: center; padding: 20px 0 15px; border-bottom: 2px solid #065f46; margin-bottom: 20px; }
        .header h1 { font-size: 18px; color: #065f46; margin-bottom: 3px; }
        .header p { font-size: 10px; color: #6b7280; }

        .period { text-align: center; font-size: 12px; color: #374151; margin-bottom: 20px; }

        .summary { display: table; width: 100%; margin-bottom: 20px; border-spacing: 8px; }
        .summary-item { display: table-cell; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 10px; text-align: center; width: 33%; }
        .summary-item.purple { background: #faf5ff; border-color: #e9d5ff; }
        .summary-item.blue { background: #eff6ff; border-color: #bfdbfe; }
        .summary-label { font-size: 9px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; }
        .summary-value { font-size: 14px; font-weight: bold; color: #065f46; margin-top: 3px; }
        .summary-item.purple .summary-value { color: #7c3aed; }
        .summary-item.blue .summary-value { color: #1d4ed8; }

        .section-title { font-size: 13px; font-weight: bold; color: #065f46; margin-bottom: 8px; padding-bottom: 4px; border-bottom: 1px solid #d1fae5; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #065f46; color: white; padding: 7px 8px; text-align: left; font-size: 10px; }
        td { padding: 6px 8px; border-bottom: 1px solid #f3f4f6; font-size: 10px; }
        tr:nth-child(even) td { background: #f9fafb; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        tfoot td { font-weight: bold; background: #f0fdf4; border-top: 2px solid #065f46; }

        .footer { text-align: center; margin-top: 30px; padding-top: 10px; border-top: 1px solid #e5e7eb; font-size: 9px; color: #9ca3af; }
    </style>
</head>
<body>

    <div class="header">
        <h1>TPQ Al-Mukharijin</h1>
        <p>Laporan Keuangan Donasi & Penggunaan Dana</p>
    </div>

    <div class="period">
        Periode: {{ $bulanNama }} {{ $tahun }}
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-label">Total Donasi</div>
            <div class="summary-value">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</div>
        </div>
        <div class="summary-item purple">
            <div class="summary-label">Total Penggunaan</div>
            <div class="summary-value">Rp {{ number_format($totalPenggunaan, 0, ',', '.') }}</div>
        </div>
        <div class="summary-item blue">
            <div class="summary-label">Sisa Dana</div>
            <div class="summary-value">Rp {{ number_format($sisaDana, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="section-title">Rincian Donasi ({{ $donasis->count() }} transaksi)</div>
    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:15%">Tanggal</th>
                <th style="width:20%">Donatur</th>
                <th style="width:25%">Program</th>
                <th style="width:15%" class="text-right">Jumlah</th>
                <th style="width:10%">Metode</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donasis as $i => $d)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $d->created_at->format('d/m/Y') }}</td>
                <td>{{ $d->nama_donatur }}</td>
                <td>{{ $d->program->nama_program ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                <td class="text-center">{{ strtoupper($d->metode) }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
        @if ($donasis->count())
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Total</td>
                <td class="text-right">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="section-title">Rincian Penggunaan Dana ({{ $penggunaans->count() }} transaksi)</div>
    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:15%">Tanggal</th>
                <th style="width:40%">Uraian</th>
                <th style="width:25%">Program</th>
                <th style="width:15%" class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penggunaans as $i => $p)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                <td>{{ $p->uraian }}</td>
                <td>{{ $p->program->nama_program ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
        @if ($penggunaans->count())
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Total</td>
                <td class="text-right">Rp {{ number_format($totalPenggunaan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d F Y, H:i') }} WIB &mdash; TPQ Al-Mukharijin &copy; {{ date('Y') }}
    </div>

</body>
</html>