<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memoriam_quotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memoriam_id');
            $table->text('quote');
            $table->timestamps();
        });

        Schema::table('memoriam_quotes', function (Blueprint $table) {
            $table->foreign('memoriam_id')
                  ->references('id')
                  ->on('memoriam')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memoriam_quotes');
    }
};