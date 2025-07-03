<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    public function index(){

        $user = Auth::user();

        $fines = Fine::whereHas('borrowing', function($query) use($user){
            $query->where('user_id', $user->id);
        })->with('borrowing')->get();
        return view('fines.index', compact('fines', 'user'));

    }

    public function showAll(){
        $allFines = Fine::with(['borrowing.user', 'borrowing.book'])->get();

        return view('fines.all', compact('allFines'));
    }

    public function pay(String $id){
        $fine = Fine::findOrFail($id);

        $fine->delete();

        return redirect()->route('fines.index')->with('session', 'Fine is Paid 💸');
    }
}
