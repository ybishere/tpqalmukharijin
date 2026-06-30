<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $primaryKey = 'id_penggunaan';

    protected $fillable = [
        'program_id',
        'admin_id',
        'uraian',
        'jumlah',
        'bukti_foto',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id_program');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id_admin');
    }
}