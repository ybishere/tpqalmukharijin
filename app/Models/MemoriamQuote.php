<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoriamQuote extends Model
{
    protected $fillable = ['memoriam_id', 'quote'];

    public function memoriam()
    {
        return $this->belongsTo(Memoriam::class);
    }
}