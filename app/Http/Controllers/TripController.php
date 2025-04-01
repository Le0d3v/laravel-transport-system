<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Truck;
use App\Models\Seating;
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
        $trips = Trip::all();
        $terminals = Terminal::where("status", "1")->get();
        $trucks = Truck::where("status", "1")->get();
        return view("admin.trips.create", [
            "terminals" => $terminals,
            "trucks" => $trucks,
            "trips" => $trips
        ]);

    }
    public function store(Request $request) {
        $truck = Truck::find($request->truck_id);

        $request->validate([
            'origin' => ['required', 'numeric',],
            'destination' => ['required', 'numeric'],
            'output_date' => ['required', 'date'],
            'output_time' => ['required'],
            'arrival_date' => ['required', 'date'],
            'arrival_time' => ['required'],
            'truck_id' => ['required', 'numeric']
        ]);

        $trip = Trip::create([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'output_date' => $request->output_date,
            'output_time' => $request->output_time,
            'arrival_date' => $request->arrival_date,
            'arrival_time' => $request->arrival_time,
            'truck_id' => $request->truck_id,
            'seatings' => $truck->capacity,
            'availables' => $truck->availables,
        ]);

        $asientos_A = [];
        for ($i = 1; $i <= 16; $i++) {
            $asientos_A[] = [
                'name' => 'A' . $i,
                'status' => 0,
                'trip_id' => $trip->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $asientos_B = [];
        for ($i = 1; $i <= 16; $i++) {
            $asientos_B[] = [
                'name' => 'B' . $i,
                'status' => 0,
                'trip_id' => $trip->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $asientos_C = [];
        for ($i = 1; $i <= 6; $i++) {
            $asientos_C[] = [
                'name' => 'C' . $i,
                'status' => 0,
                'trip_id' => $trip->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Seating::insert($asientos_C);
        Seating::insert($asientos_B);
        Seating::insert($asientos_A);


        return redirect(route('trips', absolute: false));
    }

    public function edit($id) {
        $trip = Trip::find($id);
        $terminals = Terminal::all();
        $trucks = Truck::all();
        return view("admin.trips.edit", [
            "trip" => $trip,
            "terminals" => $terminals,
            "trucks" => $trucks
        ]);
    }

    public function update(Request $request, $id) {
        $trip = Trip::find($id);
        
        $request->validate([
            'origin' => ['required', 'numeric',],
            'destination' => ['required', 'numeric'],
            'output_date' => ['required', 'date'],
            'output_time' => ['required'],
            'arrival_date' => ['required', 'date'],
            'arrival_time' => ['required'],
            'truck_id' => ['required', 'numeric']
        ]);

        $bus = Truck::find($request->truck_id);

        $trip->origin = $request->origin;
        $trip->destination = $request->destination;
        $trip->output_time = $request->output_time;
        $trip->output_date = $request->output_date;
        $trip->arrival_date = $request->arrival_date;
        $trip->arrival_time = $request->arrival_time;
        $trip->truck_id = $request->truck_id;
        $trip->seatings = $bus->capacity;
        $trip->availables = $bus->capacity;

        $trip->save();

        return redirect(route('trips', absolute: false));
    }
    public function destroy($id) {
        $trip = Trip::find($id);
        $trip->delete();

        return redirect(route('trips', absolute: false));
    }
}
