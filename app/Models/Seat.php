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
        'minimum_order',
        'max_capacity',
        'order',
        'prices',
    ];

    /**
     * Get the prices attribute and unserialize it.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getPricesAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Set the prices attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setPricesAttribute($value)
    {
        $this->attributes['prices'] = json_encode($value);
    }

    public function eventSession()
    {
        return $this->belongsTo(EventSession::class);
    }

    public function bookings()
    {
        return $this->hasMany(SeatBooking::class);
    }
}
