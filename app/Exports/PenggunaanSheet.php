<?php

namespace App\Exports;

use App\Models\Penggunaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenggunaanSheet implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function __construct(
        public string $tahun,
        public ?string $bulan = null,
        public ?int $program_id = null
    ) {}

    public function collection()
    {
        $query = Penggunaan::with('program')
            ->whereYear('created_at', $this->tahun);

        if ($this->bulan)      $query->whereMonth('created_at', $this->bulan);
        if ($this->program_id) $query->where('program_id', $this->program_id);

        return $query->get()->map(fn($p, $i) => [
            'No'      => $i + 1,
            'Tanggal' => $p->created_at->format('d/m/Y'),
            'Uraian'  => $p->uraian,
            'Program' => $p->program->nama_program ?? '-',
            'Jumlah'  => $p->jumlah,
        ]);
    }

    public function headings(): array
    {
        return ['No', 'Tanggal', 'Uraian', 'Program', 'Jumlah (Rp)'];
    }

    public function title(): string
    {
        return 'Penggunaan Dana';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4C1D95']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 40,
            'D' => 25,
            'E' => 15,
        ];
    }
}