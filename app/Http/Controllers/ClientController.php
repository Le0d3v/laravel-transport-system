<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Seating;
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
        $seatings_A = Seating::whereIn('name', ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10', 'A11', 'A12', 'A13', 'A14', 'A15', 'A16'])  
           ->where("trip_id", $id)
            ->get();

        $seatings_B = Seating::whereIn('name', ['B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9', 'B10', 'B11', 'B12', 'B13', 'B14', 'B15', 'B16'])     
            ->where("trip_id", $id)
            ->get();

        $seatings_C = Seating::whereIn('name', ['C1', 'C2', 'C3', 'C4', 'C5', 'C6'])
            ->where("trip_id", $id)
            ->get();
    
        return view("user.trips.buy", [
            "trip" => $trip,
            "seatings_A" => $seatings_A,
            "seatings_B" => $seatings_B,
            "seatings_C" => $seatings_C,
        ]);
    }
}
