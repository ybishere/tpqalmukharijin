<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'nama_program'   => 'Papan Tulis Kelas',
                'deskripsi'      => 'Pengadaan papan tulis baru untuk 3 kelas TPQ yang sudah rusak.',
                'target_dana'    => 1000000,
                'dana_terkumpul' => 780000,
                'status'         => 'aktif',
            ],
            [
                'nama_program'   => 'Al-Qur\'an Baru',
                'deskripsi'      => 'Pengadaan 20 Al-Qur\'an baru untuk santri yang belum memiliki.',
                'target_dana'    => 1000000,
                'dana_terkumpul' => 450000,
                'status'         => 'aktif',
            ],
            [
                'nama_program'   => 'Renovasi Kelas',
                'deskripsi'      => 'Renovasi dinding dan lantai kelas utama TPQ Al-Mukharijin.',
                'target_dana'    => 5000000,
                'dana_terkumpul' => 1100000,
                'status'         => 'aktif',
            ],
            [
                'nama_program'   => 'Kipas Angin',
                'deskripsi'      => 'Pengadaan kipas angin untuk 2 kelas agar santri nyaman belajar.',
                'target_dana'    => 500000,
                'dana_terkumpul' => 455000,
                'status'         => 'aktif',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}