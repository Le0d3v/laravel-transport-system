<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Terminal;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $date = Carbon::now()->format("Y-m-d");
        $trips = Trip::all();
        $terminals = Terminal::all();
        return view("user.trips.index", [
            "trips" => $trips,
            "terminals" => $terminals
        ]); 
    }

    public function buy($id) {
        $trip = Trip::find($id);
        return view("user.trips.buy", [
            "trip" => $trip
        ]);
    }
}
