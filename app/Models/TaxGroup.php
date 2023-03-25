<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxGroup extends Model {
    protected $fillable = [
        'name',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function prices() {
        return $this->hasMany(Price::class);
    }

    public function rules() {
        return $this->belongsToMany(TaxRule::class);
    }
};