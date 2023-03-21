<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalProducts extends Model
{    protected $table = 'rental_products';
    protected $fillable = [
        'name',
        'description',
        'image',
    ];
}