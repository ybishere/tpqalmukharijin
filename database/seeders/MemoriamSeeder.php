<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemoriamSeeder extends Seeder
{
    public function run(): void
    {
        $memoriam = [
            [
                'nama'       => 'KH. Ahmad Syafi\'i',
                'foto'       => null,
                'tahun_lahir'=> 1942,
                'tahun_wafat'=> 2008,
                'biografi'   => 'KH. Ahmad Syafi\'i adalah pendiri sekaligus pengasuh pertama TPQ Al-Mukharijin. Beliau dikenal sebagai sosok ulama yang alim, wara\', dan penuh kasih sayang kepada para santrinya. Lahir di Tegal pada tahun 1942, beliau menempuh pendidikan pesantren di berbagai pondok pesantren di Jawa Tengah dan Jawa Timur. Sepulang dari menimba ilmu, beliau mendedikasikan hidupnya untuk mengajarkan Al-Quran kepada masyarakat Desa Kreman.',
                'urutan'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Nyai Hj. Maryam',
                'foto'       => null,
                'tahun_lahir'=> 1948,
                'tahun_wafat'=> 2015,
                'biografi'   => 'Nyai Hj. Maryam adalah istri KH. Ahmad Syafi\'i sekaligus penggerak utama pendidikan Al-Quran bagi santri putri di TPQ Al-Mukharijin. Beliau dikenal dengan kelembutan dan kesabarannya dalam mengajar. Dedikasi beliau kepada pendidikan Al-Quran menjadi inspirasi bagi para pengajar hingga saat ini.',
                'urutan'     => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($memoriam as $data) {
            $id = DB::table('memoriam')->insertGetId($data);

            $quotes = [
                1 => [
                    'Ilmu tanpa amal bagaikan pohon tanpa buah. Ajarkanlah Al-Quran kepada anak-anakmu, karena ia adalah sebaik-baik bekal kehidupan.',
                    'Jangan pernah berhenti belajar Al-Quran, karena setiap huruf yang kamu baca adalah cahaya di hati dan di hari kiamat.',
                ],
                2 => [
                    'Didiklah anakmu dengan Al-Quran sejak dini, karena hati yang muda bagaikan batu yang siap diukir.',
                    'Sabar dan ikhlas adalah kunci dalam mendidik. Hasilnya serahkan kepada Allah.',
                ],
            ];

            foreach (($quotes[$data['urutan']] ?? []) as $quote) {
                DB::table('memoriam_quotes')->insert([
                    'memoriam_id' => $id,
                    'quote'       => $quote,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}