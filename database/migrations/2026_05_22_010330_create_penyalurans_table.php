<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id('id_penyaluran');
            $table->foreignId('donasi_id')->constrained('donasis', 'id_donasi')->onDelete('cascade');
            $table->text('keterangan');
            $table->decimal('jumlah_salur', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};