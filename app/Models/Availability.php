<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $casts = [
        'starts_specific' => 'json',
    ];

    protected $fillable = [
        'times',
        'start_time',
        'end_time',
        'starts_every',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun',
        'starts_specific',
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
