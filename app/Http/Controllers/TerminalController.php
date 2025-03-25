<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function index() {
        $terminals = Terminal::all();
        return view("admin.terminals.index", [
            "terminals" => $terminals
        ]);
    }
    public function create() {
        return view("admin.terminals.create"); 
    }
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'cp' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'lat' => ['required', 'string', 'max:255'],
            'lng' => ['required', 'string', 'max:255'],
        ]);

        $terminal = Terminal::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'state' => $request->state,
            'cp' => $request->cp,
            'status' => $request->status,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        return redirect(route('terminals.index', absolute: false));
    }
    public function edit($id) {
        $terminal = Terminal::find($id);
        return view("admin.terminals.edit", [
            "terminal" => $terminal
        ]);
    }
    public function update(Request $request, $id) {
        $terminal = Terminal::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'cp' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'lat' => ['required', 'string', 'max:255'],
            'lng' => ['required', 'string', 'max:255'],
        ]);

        $terminal->name = $request->name;
        $terminal->telephone = $request->telephone;
        $terminal->address = $request->address;
        $terminal->state = $request->state;
        $terminal->cp = $request->cp;
        $terminal->status = $request->status;
        $terminal->lat = $request->lat;
        $terminal->lng = $request->lng;

        $terminal->save();

        return redirect(route("terminals.index", absolute: false));
    }

    public function destroy($id) {
        $terminal = Terminal::find($id);
        $terminal->delete();
        
        return redirect(route("terminals.index", absolute: false));
    }
}
