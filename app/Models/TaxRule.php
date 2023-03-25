<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRule extends Model {
    protected $fillable = [
        'name',
        'amount',
        'type',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function groups() {
        return $this->belongsToMany(TaxGroup::class);
    }
};