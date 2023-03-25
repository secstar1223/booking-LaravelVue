<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'equipment_number',
        'is_order_reserved',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
