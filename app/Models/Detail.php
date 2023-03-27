<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {
	 protected $table = 'rental_products';
	 
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function groups() {
        return $this->belongsToMany(TaxGroup::class);
    }
	
	public function equipments() {
        return $this->hasMany(Equipment::class);
    }

    public function durations() {
        return $this->hasMany(Duration::class);
    }
};