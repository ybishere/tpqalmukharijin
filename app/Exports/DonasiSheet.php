<?php

namespace App\Exports;

use App\Models\Donasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonasiSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(
        public string $tahun,
        public ?string $bulan = null,
        public ?int $program_id = null
    ) {}

    public function collection()
    {
        $query = Donasi::with('program')
            ->where('status_bayar', 'sukses')
            ->whereYear('created_at', $this->tahun);

        if ($this->bulan)      $query->whereMonth('created_at', $this->bulan);
        if ($this->program_id) $query->where('program_id', $this->program_id);

        return $query->get()->map(fn($d, $i) => [
            'No'       => $i + 1,
            'Tanggal'  => $d->created_at->format('d/m/Y H:i'),
            'Donatur'  => $d->nama_donatur,
            'Program'  => $d->program->nama_program ?? '-',
            'Jumlah'   => $d->jumlah,
            'Metode'   => strtoupper($d->metode),
            'Referensi' => $d->midtrans_id ?? '#'.str_pad($d->id_donasi, 6, '0', STR_PAD_LEFT),
        ]);
    }

    public function headings(): array
    {
        return ['No', 'Tanggal', 'Donatur', 'Program', 'Jumlah (Rp)', 'Metode', 'No. Referensi'];
    }

    public function title(): string
    {
        return 'Donasi';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF065F46']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 18,
            'C' => 20,
            'D' => 25,
            'E' => 15,
            'F' => 10,
            'G' => 30,
        ];
    }
}