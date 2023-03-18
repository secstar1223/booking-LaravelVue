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
        'language',
        'options',
        'schedule',
        'schedule_exceptions'
    ];

    /**
     * Get the language attribute and unserialize it.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getLanguageAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Set the language attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setLanguageAttribute($value)
    {
        $this->attributes['language'] = json_encode($value);
    }

    /**
     * Get the options attribute and unserialize it.
     *
     * @param  mixed  $value
     * @return array|null
     */
    public function getOptionsAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Set the options attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
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

        return json_decode($value, true);
    }

    /**
     * Set the schedule attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setScheduleAttribute($value)
    {
        $this->attributes['schedule'] = json_encode($value);
    }

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

        return json_decode($value, true);
    }

    /**
     * Set the schedule attribute and serialize it.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setScheduleExceptionsAttribute($value)
    {
        $this->attributes['schedule_exceptions'] = json_encode($value);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function seats() {
        return $this->hasMany(Seats::class);
    }
}