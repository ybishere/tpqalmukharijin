<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ActivityPhoto extends Model
{
    protected $fillable = ['activity_id', 'foto', 'keterangan'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}