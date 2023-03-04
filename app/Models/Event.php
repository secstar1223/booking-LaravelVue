<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function eventSessions() {
        return $this->hasMany(EventSession::class);
    }
}