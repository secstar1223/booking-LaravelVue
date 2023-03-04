<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'max_available',
        'price',
    ];

    public function eventSession()
    {
        return $this->belongsTo(EventSession::class);
    }

    public function bookings()
    {
        return $this->hasMany(SeatBooking::class);
    }
}
