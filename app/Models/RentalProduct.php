<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalProduct extends Model {
    protected $fillable = [
        'name',
        'description',
        'image',
        'language',
        'options',
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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function equipments() {
        return $this->hasMany(Equipment::class);
    }

    public function durations() {
        return $this->hasMany(Duration::class);
    }

    public function availabilities() {
        return $this->hasMany(Availability::class);
    }
}