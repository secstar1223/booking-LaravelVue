<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $fillable = [
        'name',
        'duration',
		'buffer',
    ];

    public function Details()
    {
        return $this->belongsTo(Details::class);
    }

    public function availabilities() {
        return $this->belongsToMany(Availability::class);
    }
}