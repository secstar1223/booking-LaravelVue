<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {
    protected $fillable = [
        'total',
        'deposit',
    ];

    public function equipmenttype()
    {
        return $this->belongsTo(Equipmenttype::class);
    }

    public function duration() {
        return $this->belongsTo(Duration::class);
    }
	
	public function details() {
        return $this->belongsTo(Details::class);
    }
};