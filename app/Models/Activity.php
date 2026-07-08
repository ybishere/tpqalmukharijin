<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['judul','deskripsi','tanggal','status','thumbnail'];

    public function photos()
    {
        return $this->hasMany(ActivityPhoto::class);
    }
}