<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

});


 //-------------------------------------------------------------------


//routes for all users
Route::middleware(['auth'])->group(function () {

    //books
    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

    //authors
    Route::get('/author/index', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/author/{id}', [AuthorController::class, 'show'])->name('authors.show');


    //categories
    Route::get('/category/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('categories.show');
});

//routes for admins and librarians
Route::middleware(['auth', 'role:admin,librarian'])->group(function () {

    //books
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

    //fines
    Route::get('/fines/all', [FineController::class, 'showAll'])->name('fines.all');

    //borrowings
    Route::get('/borrowings', [BorrowingController::class, 'showAll'])->name('show.all.borrowings');
    Route::get('/history', [BorrowingController::class, 'showHistory'])->name('borrowings.history');
});



// routes for admins only 💻
Route::middleware(['auth', 'role:admin'])->group(function () {
    // routes

    //users
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/store/{id}', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});

// routes for librarians only 📚
Route::middleware(['auth', 'role:librarian'])->group(function () {


    // books
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');

    Route::delete('books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    // authors
    Route::get('authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/author/{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/author/{id}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    //categories
    Route::get('category/create',[CategoryController::class, 'create'])->name('categories.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


});

// routes for students only 👨🏼‍🎓
Route::middleware(['auth', 'role:student'])->group(function () {

    //books
    Route::post('/books/{id}/return', [BookController::class, 'return'])->name('books.return');
    Route::post('books/details/{id}', [BookController::class, 'borrow'])->name('borrow.book');

    //fines
    Route::get('/fines/index', [FineController::class, 'index'])->name('fines.index');
    Route::delete('/fines/{id}/pay', [FineController::class, 'pay'])->name('fines.pay');

    //borrowings
    Route::get('borrowings/my/{id}', [BorrowingController::class, 'showMy'])->name('show.my.borrowings');
    Route::get('borrowings/my-history/{id}', [BorrowingController::class, 'showMyHistory'])->name('show.my.history');
    Route::put('borrowings/my/{id}', [BorrowingController::class, 'return'])->name('borrowing.return');
});
