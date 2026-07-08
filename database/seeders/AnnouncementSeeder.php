<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'judul'          => 'Pendaftaran Santri Baru Tahun Ajaran 2025/2026',
                'isi'            => 'Assalamu\'alaikum Wr. Wb. Dengan memohon ridho Allah SWT, TPQ Al-Mukharijin membuka pendaftaran santri baru untuk tahun ajaran 2025/2026. Pendaftaran dibuka mulai tanggal 1 Juli hingga 31 Agustus 2025. Syarat pendaftaran: usia minimal 5 tahun, fotokopi KTP orang tua, fotokopi akta kelahiran, dan pas foto 3x4 sebanyak 2 lembar. Biaya pendaftaran gratis. Informasi lebih lanjut hubungi pengurus TPQ. Wassalamu\'alaikum Wr. Wb.',
                'thumbnail'      => null,
                'tanggal_publish'=> '2025-07-01',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'judul'          => 'Libur Akhir Tahun Ajaran dan Jadwal Wisuda Santri',
                'isi'            => 'Diberitahukan kepada seluruh wali santri bahwa TPQ Al-Mukharijin akan mengadakan libur akhir tahun ajaran pada tanggal 15-30 Juni 2025. Kegiatan wisuda santri yang telah menyelesaikan jilid akan dilaksanakan pada tanggal 14 Juni 2025 pukul 08.00 WIB bertempat di halaman TPQ Al-Mukharijin. Mohon kehadiran seluruh wali santri.',
                'thumbnail'      => null,
                'tanggal_publish'=> '2025-06-01',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'judul'          => 'Perubahan Jadwal Kegiatan Belajar Mengajar Bulan Ramadhan',
                'isi'            => 'Selama bulan Ramadhan 1446 H, kegiatan belajar mengajar TPQ Al-Mukharijin akan mengalami perubahan jadwal. KBM dilaksanakan setelah sholat Tarawih pukul 20.00 - 21.30 WIB. Program tambahan selama Ramadhan meliputi: tadarus bersama, kultum santri, dan pesantren kilat. Informasi lengkap akan disampaikan melalui grup WhatsApp wali santri.',
                'thumbnail'      => null,
                'tanggal_publish'=> '2025-02-20',
                'is_active'      => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        DB::table('announcements')->insert($announcements);
    }
}