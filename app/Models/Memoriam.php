<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Memoriam extends Model
{
    protected $table = 'memoriam';
    protected $fillable = ['nama','foto','tahun_lahir','tahun_wafat','biografi','urutan'];

    public function quotes()
    {
        return $this->hasMany(MemoriamQuote::class);
    }

    public function photos()
    {
        return $this->hasMany(MemoriamPhoto::class);
    }
}