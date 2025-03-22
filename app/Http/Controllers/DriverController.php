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

        return redirect(route('drivers.index', absolute: false))->with("message", "Registro Exitoso");
    }

    public function edit(Driver $driver) {
        return view("admin.drivers.edit", [
            "driver" => $driver
        ]);
    }

    public function update(Request $request) {
        
    }
}
