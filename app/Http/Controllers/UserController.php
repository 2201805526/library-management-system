<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(String $id){
        $user = User::findOrFail($id);
        return view('users.details', compact('user'));
    }

    public function destroy(String $id){
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User\'s been deleted ❗');
    }

    public function edit(String $id){
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, String $id){

        $user = User::findOrFail($id);

        $request->validate([
            'name'=> 'required|string|max:200',
            'email'=> 'required|email',
            'password'=> 'nullable|string|min:8|confirmed',
            'role'=> 'required|in:admin,librarian,student'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated 🔃');
    }
}
