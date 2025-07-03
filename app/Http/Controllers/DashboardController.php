<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return view('dashboards.admin');
        }

        if ($role === 'librarian') {
            return view('dashboards.librarian');
        }

        if ($role === 'student') {
            return view('dashboards.student');
        }

        // fallback
        abort(403, 'Unauthorized.');
    }

}
