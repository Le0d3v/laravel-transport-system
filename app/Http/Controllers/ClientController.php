<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Terminal;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $trips = Trip::all();
        $terminals = Terminal::all();
        return view("user.trips.index", [
            "trips" => $trips,
            "terminals" => $terminals
        ]); 
    }
}
