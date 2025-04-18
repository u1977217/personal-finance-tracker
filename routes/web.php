<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Default route -> redirect to books
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'storeRegisteredUser'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Book routes (all behind auth)
Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/about', [BookController::class, 'about'])->name('books.about');
    Route::get('/books/contact', [BookController::class, 'contact'])->name('books.contact');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    // AJAX routes for authors, genres, statuses
    Route::post('/authors/store-ajax', [AuthorController::class, 'storeAjax'])
        ->name('authors.storeAjax');

    Route::post('/genres/store-ajax', [GenreController::class, 'storeAjax'])
        ->name('genres.storeAjax');

    Route::post('/statuses/store-ajax', [\App\Http\Controllers\StatusController::class, 'storeAjax'])
        ->name('statuses.storeAjax');
});
