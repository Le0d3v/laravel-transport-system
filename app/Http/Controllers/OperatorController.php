<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function index() {
        $users = User::where("rol", "1")->paginate(10);
        return view("admin.operators.index", [
            "users" => $users
        ]);
    }

    public function create() {
        return view("admin.operators.create");
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required', 
                'confirmed', 
                "string", 
                "min:10", 
                "regex:/[1-9]/", 
                'regex:/[!@#$%^&*(),.?":{}|<>]/'
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => '1'
        ]);

        return redirect(route('operators', absolute: false));
    }

    public function edit(User $user) {
        $user = User::find($user->id);
        return view("admin.operators.edit", [
            "user" => $user
        ]);
    }

    public function update(Request $request, User $user) {
        $user = User::find($user->id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $user->name = $request->input("name");
        $user->name = $request->input("email");

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect(route('operators', absolute: false));
    }

    public function destroy(User $user) {
        $user = User::find($user->id);
        $user->delete();

        return redirect(route('operators', absolute: false));
    }
}
