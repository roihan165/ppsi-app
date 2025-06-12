<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserWeb;

class Register extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_webs',
            'password' =>'required'
        ]);

        UserWeb::create($request->all());
        return redirect()->back()->with('success', 'User added successfully.');
    }
}
