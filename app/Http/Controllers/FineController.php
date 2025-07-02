<?php

namespace App\Http\Controllers;

use App\Models\Fine;

class FineController extends Controller
{
    public function index(){
        $fines = Fine::with(['borrowing.user', 'borrowing.book'])->get();
        return view('fines.index', compact('fines'));

    }

    public function showAll(){
        $allFines = Fine::with(['borrowing.user', 'borrowing.book'])->get();

        return view('fines.all', compact('allFines'));
    }
}
