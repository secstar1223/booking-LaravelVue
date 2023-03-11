<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'schedule',
        'schedule_exceptions'
    ];

    /**
     * Get the schedule attribute and unserialize it.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getScheduleExceptionsAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return unserialize($value);
    }

    /**
     * Set the schedule attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setScheduleExceptionsAttribute($value)
    {
        $this->attributes['schedule_exceptions'] = serialize($value);
    }

    /**
     * Get the schedule attribute and unserialize it.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getScheduleAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return unserialize($value);
    }

    /**
     * Set the schedule attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setScheduleAttribute($value)
    {
        $this->attributes['schedule'] = serialize($value);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function seats() {
        return $this->hasMany(Seats::class);
    }
}