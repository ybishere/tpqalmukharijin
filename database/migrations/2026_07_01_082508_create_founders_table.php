<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('founders', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('foto')->nullable();
        $table->string('jabatan');
        $table->enum('status', ['Pengasuh', 'Pengajar']);
        $table->string('keterangan')->nullable();
        $table->text('quotes')->nullable();
        $table->integer('urutan')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('founders');
    }
};
