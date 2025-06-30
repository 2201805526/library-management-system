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

    //dashboards
    Route::get('dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');

    //users
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');

    //books
    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.details');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/store/{id}', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/update/{id}', [BookController::class, 'update'])->name('books.update');


});

// routes for librarians
Route::middleware(['auth', 'role:librarian'])->group(function(){
    //routes

    //dashboards
    Route::get('dashboard/librarian', [DashboardController::class, 'index'])->name('dashboard.librarian');

    //books
    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.details');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/store/{id}', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/update/{id}', [BookController::class, 'update'])->name('books.update');

});

// routes for students
Route::middleware(['auth', 'role:student'])->group(function(){
    //routes

    //dashboards
    Route::get('dashboard/student', [DashboardController::class, 'index'])->name('dashboard.student');

    //books
    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.show');

    //borrowings
    Route::get('/borrowings/my', [BorrowingController::class, 'index'])->name('borrowings.index');

    //fines
    Route::get('/fines/index', [FineController::class, 'index'])->name('fines.index');

});
