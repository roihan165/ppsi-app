<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Chart extends Controller
{
    public function index() {
        return view('user_chart');
    }
}
