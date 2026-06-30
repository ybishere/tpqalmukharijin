<?php

namespace App\Exports;

use App\Models\Donasi;
use App\Models\Penggunaan;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanExport implements WithMultipleSheets
{
    public function __construct(
        public string $tahun,
        public ?string $bulan = null,
        public ?int $program_id = null
    ) {}

    public function sheets(): array
    {
        return [
            'Donasi'    => new DonasiSheet($this->tahun, $this->bulan, $this->program_id),
            'Penggunaan' => new PenggunaanSheet($this->tahun, $this->bulan, $this->program_id),
        ];
    }
}