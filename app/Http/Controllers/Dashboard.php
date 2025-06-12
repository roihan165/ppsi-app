<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index() {
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
