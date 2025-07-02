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

/*
 -----------------------------------------------------------------------------------------------------------------------------------------
*/

//routes for all users
Route::middleware(['auth'])->group(function(){
    //books
    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');


});

//routes for admins and librarians
Route::middleware(['auth', 'role:admin,librarians'])->group(function(){

    //books
    Route::controller(BookController::class)->group(function(){

    // Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create',  'create')->name('books.create');
    Route::post('/books/store/{id}', 'store')->name('books.store');
    Route::get('/books/{id}/edit', 'edit')->name('books.edit');
    // Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::put('/books/{id}', 'update')->name('books.update');
    Route::delete('books/{id}', 'destroy')->name('books.destroy');
    });

    Route::controller(FineController::class)->group(function(){
        Route::get('/fines/all', 'showAll')->name('fines.all');
    });

});



// routes for admins only 💻
Route::middleware(['auth', 'role:admin'])->group(function(){
    // routes

    //dashboards
    Route::get('dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');

    //users
    Route::controller(UserController::class)->group(function(){
        Route::get('/users/index', 'index')->name('users.index');
        Route::get('/users/show/{id}', 'show')->name('users.show');
        Route::post('/users/store/{id}', 'store')->name('users.store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('/users/{id}', 'update')->name('users.update');
        Route::delete('/users/{id}', 'destroy')->name('users.destroy');
    });
});

// routes for librarians only 📚
Route::middleware(['auth', 'role:librarian'])->group(function(){

    //dashboards
    Route::get('dashboard/librarian', [DashboardController::class, 'index'])->name('dashboard.librarian');
});

// routes for students only 👨🏼‍🎓
Route::middleware(['auth', 'role:student'])->group(function(){

    //dashboards
    Route::get('dashboard/student', [DashboardController::class, 'index'])->name('dashboard.student');

    //books
    // Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    // Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

    //borrowings
    Route::get('/borrowings/my', [BorrowingController::class, 'index'])->name('borrowings.index');

    //fines
    Route::get('/fines/index', [FineController::class, 'index'])->name('fines.index');

});
