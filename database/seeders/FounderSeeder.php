<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FounderSeeder extends Seeder
{
    public function run(): void
    {
        $founders = [
            [
                'nama'       => 'Ust. Abdullah Faqih',
                'foto'       => null,
                'jabatan'    => 'Kepala TPQ / Pengasuh',
                'status'     => 'Pengasuh',
                'keterangan' => 'Putra dari KH. Ahmad Syafi\'i yang melanjutkan estafet kepemimpinan TPQ Al-Mukharijin. Beliau menyelesaikan pendidikan di Pondok Pesantren Lirboyo dan aktif mengembangkan kurikulum pembelajaran Al-Quran yang modern namun tetap berlandaskan metode klasik.',
                'quotes'     => 'Mengajar Al-Quran bukan sekadar pekerjaan, ini adalah amanah yang akan dipertanggungjawabkan di hadapan Allah.',
                'urutan'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Ustadzah Fatimah Zahra',
                'foto'       => null,
                'jabatan'    => 'Koordinator Pengajar Putri',
                'status'     => 'Pengajar',
                'keterangan' => 'Lulusan STAI Tegal dengan spesialisasi ilmu Al-Quran dan Tafsir. Telah mengabdi di TPQ Al-Mukharijin selama lebih dari 8 tahun dan dikenal dengan metode mengajar yang kreatif dan menyenangkan bagi santri putri.',
                'quotes'     => 'Setiap anak adalah permata yang menunggu untuk diasah. Tugas kita adalah membantu mereka bersinar.',
                'urutan'     => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Ust. Muhammad Ilham',
                'foto'       => null,
                'jabatan'    => 'Pengajar Kelas Lanjutan',
                'status'     => 'Pengajar',
                'keterangan' => 'Hafidz Quran 30 juz lulusan Pesantren Tahfidz Al-Quran Kudus. Mengampu kelas lanjutan dan program tahfidz untuk santri yang ingin menghafal Al-Quran.',
                'quotes'     => 'Al-Quran adalah teman terbaik dalam setiap perjalanan hidup.',
                'urutan'     => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Ustadzah Nur Aini',
                'foto'       => null,
                'jabatan'    => 'Pengajar Kelas Dasar',
                'status'     => 'Pengajar',
                'keterangan' => 'Pengajar kelas dasar yang berpengalaman menangani santri usia dini. Dikenal dengan kesabarannya dalam membimbing anak-anak yang baru mengenal huruf hijaiyah.',
                'quotes'     => 'Langkah pertama membaca Al-Quran adalah yang paling berharga.',
                'urutan'     => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($founders as $data) {
            DB::table('founders')->insert($data);
        }
    }
}