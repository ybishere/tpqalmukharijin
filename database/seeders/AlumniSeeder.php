<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $alumni = [];
        $nama = [
            'Ahmad Zainuddin','Siti Rohmah','Muhammad Faisal','Nur Hidayah',
            'Abdul Aziz','Rina Wulandari','Khairul Anwar','Dewi Rahmawati',
            'Fathur Rahman','Umi Kulsum','Bagas Saputra','Lailatul Fitriah',
            'Rizky Ramadhan','Nadia Putri','Hafidz Mubarok','Sarah Amiliya',
            'Dimas Prakoso','Annisa Fitri','Yogi Setiawan','Mega Wulandari',
        ];

        foreach ($nama as $i => $n) {
            $alumni[] = [
                'nama'           => $n,
                'tahun_angkatan' => 2000 + ($i * 1),
                'keterangan'     => 'Alumni TPQ Al-Mukharijin yang telah menyelesaikan program belajar Al-Quran.',
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('alumni')->insert($alumni);
    }
}