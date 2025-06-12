<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringGizi extends Controller
{
    public function index(){
        return view('monitoringgizi');
    }
}
