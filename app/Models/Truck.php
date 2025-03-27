<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        "brand",
        "model", 
        "plate", 
        "capacity",
        "availables",
        "status",
        "driver_id"
    ];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
