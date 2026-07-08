<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProfileSeeder::class,
            MemoriamSeeder::class,
            FounderSeeder::class,
            AnnouncementSeeder::class,
            ActivitySeeder::class,
            StudentSeeder::class,
            AlumniSeeder::class,
        ]);
    }
}