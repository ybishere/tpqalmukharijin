<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    protected $primaryKey = 'id_penyaluran';

    protected $fillable = [
        'donasi_id',
        'keterangan',
        'jumlah_salur',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'donasi_id', 'id_donasi');
    }
}