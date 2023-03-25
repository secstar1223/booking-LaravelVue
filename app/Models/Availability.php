<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'availability_type',
        'first_time',
        'last_time',
        'starts_every',
        'starts_specific',
        'created_timezone',
        'display_created_timezone',
    ];

    public function rentalProduct()
    {
        return $this->belongsTo(RentalProduct::class);
    }

    public function durations()
    {
        return $this->belongsToMany(Duration::class);
    }
}
