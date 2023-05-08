<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {
    protected $fillable = [
        'total',
        'deposit',
    ];

    public function equipmenttypes()
    {
        return $this->belongsTo(Equipmenttype::class);
    }

    public function durations() {
        return $this->belongsTo(Duration::class);
    }
	
	public function detail() {
        return $this->belongsTo(Details::class);
    }
};