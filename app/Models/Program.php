<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $primaryKey = 'id_program';

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'alasan_donasi',
        'deadline',
        'target_dana',
        'dana_terkumpul',
        'foto',
        'status',
    ];

    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'program_id', 'id_program');
    }
}