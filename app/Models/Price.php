<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {
    protected $fillable = [
        'total',
        'deposit',
        'tax',
        'tax_type',
        'currency',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function duration() {
        return $this->belongsTo(Duration::class);
    }
};