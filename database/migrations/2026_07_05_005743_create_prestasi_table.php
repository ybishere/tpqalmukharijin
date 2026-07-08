<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('judul');
            $table->string('tingkat')->comment('desa, kecamatan, kabupaten, provinsi, nasional');
            $table->string('juara')->comment('Juara 1, Juara 2, dll');
            $table->string('kategori')->nullable()->comment('MTQ, Tahfidz, Pidato, dll');
            $table->year('tahun');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};