<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $fillable = [
        'name',
        'duration',
		'buffer',
        'rental_product_id',
    ];

    public function Detail()
    {
        return $this->belongsTo(Detail::class);
    }

    public function availabilities() {
        return $this->belongsToMany(Availability::class);
    }

    public function price(){
        return $this->hasMany(Price::class);
    }
}