<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $fillable = [
        "name",
        "address",
        "state",
        "cp",
        "telephone",
        "lat",
        "lng",
        "status",
    ];
}
