<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_orang_tua',
        'no_hp_orang_tua',
        'alamat',
        'kelas_jilid',
        'is_active',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'is_active'     => 'boolean',
    ];

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}