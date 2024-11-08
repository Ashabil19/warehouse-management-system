<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

// routes/web.php

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/inputbarang', function () {
    return view('inputbarang');
})->name('inputbarang');

// Route::get('/purchasing', function () {
//     return view('purchasing');
// })->name('purchasing');

Route::get('/barangmasuk', function () {
    return view('barangmasuk');
})->name('barangmasuk');


Route::get('/stock', function () {
    return view('stock');
})->name('stock');


Route::get('/kirimbarang', function () {
    return view('kirimbarang');
})->name('kirimbarang');


Route::get('/barangkeluar', function () {
    return view('barangkeluar');
})->name('barangkeluar');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
