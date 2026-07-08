<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_tpq',
        'sejarah',
        'visi',
        'misi',
        'alamat',
        'no_telp',
        'email',
        'maps_url',
        'facebook',
        'instagram',
        'youtube',
    ];
}