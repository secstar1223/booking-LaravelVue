<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {
	 protected $table = 'rental_product';
	 
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
	
	public function equipmenttypes() {
        return $this->hasMany(EquipmentType::class, 'rental_product_id');
    }
    public function availabilities() {
        return $this->hasMany(Availability::class, 'rental_product_id');
    }

    public function durations() {
        return $this->hasMany(Duration::class, 'rental_product_id');
    }

    public function prices(){
        return $this->hasMany(Price::class,'rental_product_id');
    }
};