<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    public function index() {
        // session(['user_id' => 5]);

        return view('dashboard',[
            'motorik' => '
            <ul>
                    <li>*Motorik kasar*: Mengangkat kepala saat berbaring tengkurap, gerakan kaki dan tangan acak.</li>
                    <li>*Motorik halus*: Menggenggam benda yang ada di tangan secara refleks.</li>        
                </ul>
            '
        ]);
    }
}
