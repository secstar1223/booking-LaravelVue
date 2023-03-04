<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'seat_number',
    ];

    public function eventSession()
    {
        return $this->belongsTo(EventSession::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
