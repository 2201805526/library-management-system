<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $role = Auth::user()->role;
        $users = User::all();

    if ($role === 'admin') {
        return view('dashboards.admin');
    } elseif ($role === 'librarian') {
        return view('dashboards.librarian');
    } else {
        return view('dashboards.student');
    }
    }
}
