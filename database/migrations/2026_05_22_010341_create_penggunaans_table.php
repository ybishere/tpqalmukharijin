<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggunaans', function (Blueprint $table) {
            $table->id('id_penggunaan');
            $table->foreignId('program_id')->constrained('programs', 'id_program')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->text('uraian');
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti_foto', 255)->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id_admin')->on('admins')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaans');
    }
};