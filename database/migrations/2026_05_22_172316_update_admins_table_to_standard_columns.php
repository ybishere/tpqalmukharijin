<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            // Rename kolom
            $table->renameColumn('id_admin', 'id');
            $table->renameColumn('nama', 'name');
            $table->renameColumn('kata_sandi', 'password');
            $table->renameColumn('peran', 'role');

            // Tambah kolom yang belum ada
            $table->string('avatar')->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('avatar');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->rememberToken()->after('last_login_at');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->renameColumn('id', 'id_admin');
            $table->renameColumn('name', 'nama');
            $table->renameColumn('password', 'kata_sandi');
            $table->renameColumn('role', 'peran');
            $table->dropColumn(['avatar', 'is_active', 'last_login_at', 'remember_token']);
        });
    }
};