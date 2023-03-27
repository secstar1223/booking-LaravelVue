<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model {
    protected $fillable = [
        'name',
        'amount',
        'resource_tracking',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function groups() {
        return $this->belongsToMany(Asset::class);
    }
	
	
	
	
};