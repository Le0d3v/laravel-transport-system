<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        "origin",
        "destination",
        "output_date",
        "output_time",
        "arrival_date",
        "arrival_time",
        "truck_id",
        "seatings",
        "availables"
    ];



    public function originTerminal()
    {
        return $this->belongsTo(Terminal::class, 'origin', 'id');
    }

    public function destinationTerminal()
    {
        return $this->belongsTo(Terminal::class, 'destination', 'id');
    }

    public function truck() {
        return $this->belongsTo(Truck::class);  
    }
}
