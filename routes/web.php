<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');



Route::middleware(['auth', 'librarian'])->group(function () {
    Route::get('/librarian/dashboard', [BookController::class, 'index'])->name('librarian.dashboard');
    Route::get('/librarian/create', [BookController::class, 'create'])->name('librarian.create');
    Route::post('/store-book', [BookController::class, 'store'])->name('store.book');
});
Route::get('/books/{id}', [BookController::class, 'show'])->name('book.show');
Route::post('/borrow', [BookController::class, 'borrow'])->name('borrow');
Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow');
Route::get('/borrow/history', [BorrowController::class, 'history'])->name('borrow.history');

Route::put('/borrow/{historyId}/return', [BorrowController::class, 'returnBook'])->name('borrow.return');




Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

// routes/web.php
Route::get('/librarian/borrow-history', [LibrarianController::class, 'borrowHistory'])->name('librarian.borrow.history');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/user-logs', [AdminDashboardController::class, 'userLogs'])->name('admin.user.logs');
});








require __DIR__ . '/auth.php';
