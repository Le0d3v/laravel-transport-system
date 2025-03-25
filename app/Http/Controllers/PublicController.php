<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
        $terminals = Terminal::where("status" === "1")->get();
        return view("public.index", [
            "terminas" => $terminals
        ]);
    }

    public function about() {
        return view("public.about");
    }

    public function terminals() {
        return view("public.terminals");
    }
}
