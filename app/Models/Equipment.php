<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'color',
        'quantity',
        'capacity',
        'resource_tracking',
        'description',
    ];
}