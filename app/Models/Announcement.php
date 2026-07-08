<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'judul',
        'isi',
        'thumbnail',
        'tanggal_publish',
        'is_active',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
        'is_active'       => 'boolean',
    ];
}