<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memoriam_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memoriam_id');
            $table->string('foto');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::table('memoriam_photos', function (Blueprint $table) {
            $table->foreign('memoriam_id')
                  ->references('id')
                  ->on('memoriam')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memoriam_photos');
    }
};