<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $activities = [
            [
                'judul'      => 'Wisuda Santri Khatmil Quran Tahun 2025',
                'deskripsi'  => 'Acara wisuda bagi santri yang telah menyelesaikan hafalan dan bacaan Al-Quran 30 juz. Dihadiri oleh orang tua santri, tokoh masyarakat, dan tamu undangan.',
                'tanggal'    => '2025-06-14',
                'status'     => 'selesai',
                'thumbnail'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Pesantren Kilat Ramadhan 1446 H',
                'deskripsi'  => 'Kegiatan pesantren kilat selama bulan Ramadhan yang meliputi tadarus Al-Quran, kajian tafsir, kultum santri, dan buka puasa bersama.',
                'tanggal'    => '2025-03-15',
                'status'     => 'selesai',
                'thumbnail'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Penerimaan Santri Baru Tahun Ajaran 2025/2026',
                'deskripsi'  => 'Kegiatan penerimaan dan orientasi santri baru tahun ajaran 2025/2026. Santri baru akan diperkenalkan dengan lingkungan TPQ, pengajar, dan tata tertib.',
                'tanggal'    => '2025-09-01',
                'status'     => 'akan_datang',
                'thumbnail'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Peringatan Maulid Nabi Muhammad SAW',
                'deskripsi'  => 'Kegiatan peringatan Maulid Nabi yang akan diisi dengan pembacaan sholawat, ceramah agama, dan penampilan santri berprestasi.',
                'tanggal'    => '2025-09-15',
                'status'     => 'akan_datang',
                'thumbnail'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($activities as $data) {
            DB::table('activities')->insert($data);
        }
    }
}