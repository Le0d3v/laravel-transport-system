<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
        return view("public.index");
    }

    public function about() {
        return view("public.about");
    }
}
