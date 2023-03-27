<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalEquipmentType extends Model
{
    protected $fillable = [
        'display_name',
        'equipment_pool',
        'description',
        'widget_image',
        'widget_display',
        'min_value',
        'max_value',
        'require_min',
        'category'
    ];
}
