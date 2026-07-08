<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profiles')->insert([
            'nama_tpq'   => 'TPQ Al-Mukharijin',
            'sejarah'    => 'TPQ Al-Mukharijin didirikan pada tahun 1995 oleh KH. Ahmad Syafi\'i bersama tokoh-tokoh masyarakat Desa Kreman yang memiliki kepedulian tinggi terhadap pendidikan Al-Quran generasi muda. Berawal dari serambi masjid dengan hanya belasan santri, TPQ ini terus berkembang hingga menjadi lembaga pendidikan Al-Quran yang dipercaya masyarakat sekitar. Selama lebih dari dua dekade, TPQ Al-Mukharijin telah mencetak ratusan alumni yang tersebar di berbagai penjuru negeri, membawa bekal ilmu Al-Quran dalam kehidupan sehari-hari mereka.',
            'visi'       => 'Menjadi lembaga pendidikan Al-Quran yang unggul, terpercaya, dan mampu mencetak generasi Qurani yang berakhlak mulia, cerdas, dan bermanfaat bagi agama, bangsa, dan masyarakat.',
            'misi'       => '1. Menyelenggarakan pendidikan Al-Quran yang berkualitas dengan metode pembelajaran yang efektif dan menyenangkan. 2. Membentuk karakter santri yang berakhlak mulia berdasarkan Al-Quran dan Sunnah. 3. Mengembangkan potensi santri secara optimal melalui berbagai kegiatan edukatif dan islami. 4. Membangun kerjasama yang harmonis antara lembaga, orang tua, dan masyarakat.',
            'alamat'     => 'Jl. Masjid Al-Mukharijin No. 12, Desa Kreman, Kecamatan Adiwerna, Kabupaten Tegal, Jawa Tengah 52194',
            'no_telp'    => '08123456789',
            'email'      => 'tpqalmukharijin@gmail.com',
            'maps_url'   => 'https://maps.google.com',
            'facebook'   => 'https://facebook.com/tpqalmukharijin',
            'instagram'  => 'https://instagram.com/tpqalmukharijin',
            'youtube'    => 'https://youtube.com/@tpqalmukharijin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}