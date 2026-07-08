<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [];
        $namaLaki = ['Ahmad Fauzi','Muhammad Rizki','Abdullah Hafidz','Umar Faruq','Ali Akbar','Hasan Basri','Husein Maulana','Yahya Syakir','Yusuf Hakim','Ibrahim Khalil','Ismail Amanah','Idris Shalih'];
        $namaPerempuan = ['Fatimah Azzahra','Aisyah Nur','Khadijah Salsabila','Maryam Siti','Zainab Humaira','Ruqayyah Nisa','Asma Hasanah','Hafshah Mutiara','Ummu Kultsum','Ramlah Najwa'];
        $kelas = ['Jilid 1','Jilid 2','Jilid 3','Jilid 4','Jilid 5','Jilid 6','Al-Quran'];
        $ortu = ['Bapak Hendra','Bapak Slamet','Bapak Agus','Bapak Rudi','Bapak Eko','Bapak Bambang','Bapak Wahyu'];

        foreach ($namaLaki as $i => $nama) {
            $students[] = [
                'nama'            => $nama,
                'tanggal_lahir'   => date('Y-m-d', strtotime('-' . rand(6,14) . ' years')),
                'jenis_kelamin'   => 'L',
                'nama_orang_tua'  => $ortu[$i % count($ortu)],
                'no_hp_orang_tua' => '0812' . rand(10000000, 99999999),
                'alamat'          => 'Desa Kreman RT ' . rand(1,5) . ' RW ' . rand(1,3),
                'kelas_jilid'     => $kelas[$i % count($kelas)],
                'is_active'       => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        foreach ($namaPerempuan as $i => $nama) {
            $students[] = [
                'nama'            => $nama,
                'tanggal_lahir'   => date('Y-m-d', strtotime('-' . rand(6,14) . ' years')),
                'jenis_kelamin'   => 'P',
                'nama_orang_tua'  => $ortu[$i % count($ortu)],
                'no_hp_orang_tua' => '0813' . rand(10000000, 99999999),
                'alamat'          => 'Desa Kreman RT ' . rand(1,5) . ' RW ' . rand(1,3),
                'kelas_jilid'     => $kelas[$i % count($kelas)],
                'is_active'       => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}