<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    protected $fillable = [
        "name",
        "status",
        "trip_id"
    ];
}
