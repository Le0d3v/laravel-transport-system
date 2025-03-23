<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index() {
        $drivers = Driver::all();
        return view("admin.drivers.index", [
            "drivers" => $drivers
        ]);
    }

    public function create() {
        return view("admin.drivers.create");
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telephone' => [
                'required', 
                "string", 
                "min:10", 
            ],
        ]);

        $driver = Driver::create([
            "name" => $request->name,
            "last_name" => $request->last_name,
            "telephone" => $request->telephone,
            "email" => $request->email,
            "status" => 1
        ]);

        return redirect(route('drivers.index', absolute: false));
    }

    public function edit(Driver $driver) {
        return view("admin.drivers.edit", [
            "driver" => $driver
        ]);
    }

    public function update(Request $request, $driver) {
        $driver = Driver::find($driver);


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telephone' => [
                'required', 
                "string", 
                "min:10", 
            ],  
        ]);

        $driver->name = $request->input("name");
        $driver->last_name = $request->input("last_name");
        $driver->telephone = $request->input("telephone");
        $driver->email = $request->input("email");
        $driver->status = $request->input("status");

        $driver->save();

        return redirect(route("drivers.index", absolute: false));
    }
    
    public function destroy($id) {
        $driver = Driver::find($id);
        $driver->delete();
        
        return redirect(route("drivers.index", absolute: false));
    }
}
