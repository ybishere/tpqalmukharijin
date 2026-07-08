<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'student_id',
        'judul',
        'tingkat',
        'juara',
        'kategori',
        'tahun',
        'keterangan',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}