<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckRole;



Route::get('/', function () {
    return view('welcome');
});

// Route untuk admin
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Route untuk purchasing
Route::middleware(['auth', CheckRole::class . ':purchasing'])->group(function () {
    Route::get('/purchasing', function () {
        return view('purchasing.index');
    })->name('purchasing.index'); //name berfungsi untuk jadi parameter di authencatedSessionController
});

// Route untuk logistik
Route::middleware(['auth', CheckRole::class . ':logistik'])->group(function () {
    Route::get('/logistik', function () {
        return view('logistik.index');
    })->name('logistik.index');
});

Route::middleware(['auth', CheckRole::class . ':logistik'])->group(function () {
    Route::get('/sales', function () {
        return view('sales.index');
    })->name('sales.index');
});

// Route untuk user
Route::middleware(['auth', CheckRole::class . ':user'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});



Route::resource('posts', PostController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
