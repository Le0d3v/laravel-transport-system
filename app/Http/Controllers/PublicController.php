<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
        $terminals = Terminal::all();
        return view("public.index", [
            "terminals" => $terminals
        ]);
    }

    public function about() {
        return view("public.about");
    }

    public function terminals() {
        return view("public.terminals");
    }
}
