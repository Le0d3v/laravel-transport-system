<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        "name",
        "last_name",
        "telephone",
        "email",
        "status"
    ];
}
