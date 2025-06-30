<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\FineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function(){



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});



// routes for admins
Route::middleware(['auth', 'role:admin'])->group(function(){
    // routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');

});

// routes for librarians
Route::middleware(['auth', 'role:librarian'])->group(function(){
    //routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

// routes for students
Route::middleware(['auth', 'role:student'])->group(function(){
    //routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/borrowings/my', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/fines/index', [FineController::class, 'index'])->name('fines.index');

});
