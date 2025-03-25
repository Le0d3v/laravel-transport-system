<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Truck;
use App\Models\Terminal;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index() {
        $trips = Trip::all();
        return view("admin.trips.index", [
            "trips" => $trips
        ]);
    }
    public function create() {
        $terminals = Terminal::where("status", "1")->get();
        $trucks = Truck::where("status", "1")->get();
        return view("admin.trips.create", [
            "terminals" => $terminals,
            "trucks" => $trucks,
        ]);

    }
    public function store(Request $request) {

    }
    public function edit($id) {

    }
    public function update(Request $request, $id) {

    }
    public function destroy($id) {

    }
}
