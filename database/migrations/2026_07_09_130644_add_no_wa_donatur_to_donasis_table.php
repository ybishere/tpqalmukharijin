<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('donasis', function (Blueprint $table) {
        $table->string('no_wa_donatur', 20)->nullable()->after('nama_donatur');
    });
}

public function down(): void
{
    Schema::table('donasis', function (Blueprint $table) {
        $table->dropColumn('no_wa_donatur');
    });
}
};
