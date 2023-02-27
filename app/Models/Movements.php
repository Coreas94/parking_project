<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movements extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_movement';
    protected $fillable = ['id_vehicle ', 'date_in', 'date_out', 'status', 'description'];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle', 'id_vehicle');
    }
}
