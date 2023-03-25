<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $fillable = [
        'name',
        'duration',
    ];

    public function rentalProduct()
    {
        return $this->belongsTo(RentalProduct::class);
    }

    public function availabilities() {
        return $this->belongsToMany(Availability::class);
    }
}