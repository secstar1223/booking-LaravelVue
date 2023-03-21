<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'ip',
        'attributes',
    ];

    /**
     * Get the attributes attribute and unserialize it.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getAttributesAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Set the attributes attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setAttributesAttribute($value)
    {
        $this->attributes['attributes'] = json_encode($value);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
