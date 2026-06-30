<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $primaryKey = 'id_donasi';

    protected $fillable = [
        'program_id',
        'admin_id',
        'nama_donatur',
        'jumlah',
        'metode',
        'status_bayar',
        'midtrans_id',
        'catatan',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id_program');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id_admin');
    }

    public function penyalurans()
    {
        return $this->hasMany(Penyaluran::class, 'donasi_id', 'id_donasi');
    }
}