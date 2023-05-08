<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    protected $table = 'rental_equipment_types';
    protected $fillable = [
        'name',
        'description',
        'min_amount',
        'max_amount',
        'require_min',
        'widget_image',
        'widget_display',
        'assetID',
        'rental_product_id',
    ];


    public function Detail()
    {
        return $this->belongsTo(Detail::class);
    }

}
