<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MemoriamPhoto extends Model
{
    protected $fillable = ['memoriam_id','foto','keterangan'];

    public function memoriam()
    {
        return $this->belongsTo(Memoriam::class);
    }
}