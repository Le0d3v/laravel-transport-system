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
}
