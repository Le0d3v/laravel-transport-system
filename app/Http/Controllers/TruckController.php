<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Driver;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index() {
        $trucks = Truck::all();
        return view("admin.trucks.index", [
            "trucks" => $trucks
        ]);
    }

    public function create() {
        $drivers = Driver::where("status", 1)->get();
        return view("admin.trucks.create", [
            "drivers" => $drivers
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'plate' => ['required', 'string', 'max:6'],
            'capacity' => ['required', 'numeric'],
            'driver_id' => ['required', 'numeric'],
        ]);

        $driver = Truck::create([
            "brand" => $request->brand,
            "model" => $request->model,
            "plate" => $request->plate,
            "capacity" => $request->capacity,
            "availables" => $request->capacity,
            "status" => 1,
            "driver_id" => $request->driver_id,
        ]);

        return redirect(route('trucks.index', absolute: false));
    }
    
    public function edit($id) {
        $truck = Truck::find($id);
        $drivers = Driver::where("status", 1)->get();
        return view("admin.trucks.edit", [
            "truck" => $truck, 
            "drivers" => $drivers
        ]);
    }

    public function update(Request $request, $id) {
        $truck = Truck::find($id);

        $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'plate' => ['required', 'string', 'max:6'],
            'capacity' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
            'driver_id' => ['required', 'numeric'],
        ]);

        $truck->brand = $request->input("brand");
        $truck->model = $request->input("model");
        $truck->plate = $request->input("plate");
        $truck->capacity = $request->input("capacity");
        $truck->availables = $request->input("capacity");
        $truck->status = $request->input("status");
        $truck->driver_id = $request->input("driver_id");

        $truck->save();

        return redirect(route("trucks.index", absolute: false));
    }

    public function destroy($id) {
        $truck = Truck::find($id);
        $truck->delete();
        
        return redirect(route("trucks.index", absolute: false));
    }
}

