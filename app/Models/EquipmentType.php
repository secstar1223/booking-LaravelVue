<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    protected $fillable = [
        'name',
        'description',
		'min-amount',
		'max-amount',
		'require-min',
		'widget-image',
		'widget-display',
		'asset_id',
    ];

    public function rentalProduct()
    {
        return $this->belongsTo(RentalProduct::class);
    }

}
