<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function index() {
        $users = UserData::all();
        return view('index',compact('users'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_data'
        ]);

        UserData::create($request->all());
        return redirect()->back()->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        $user = UserData::findOrFail($id);
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = UserData::findOrFail($id);
        $user->update($request->all());
        return redirect('/')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        UserData::destroy($id);
        return redirect()->back()->with('success', 'User deleted.');
    }

}
