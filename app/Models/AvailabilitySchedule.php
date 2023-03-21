<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailabilitySchedule extends Model
{
    protected $table = 'availability_schedule';
    protected $fillable = [
        'availability_type',
        'start_time',
        'end_time',
        'can_book_between',
        'event_id',
        'seat_id'
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
