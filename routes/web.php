<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangMasukController;



Route::get('/', function () {
    return view('home');
});

// routes/web.php

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/inputbarang', function () {
    return view('barangmasuk.create');
})->name('inputbarang');

// Route::get('/purchasing', function () {
//     return view('purchasing');
// })->name('purchasing');

Route::get('/barangmasuk', function () {
    return view('barangmasuk.index');
})->name('barangmasuk');


Route::get('/stock', function () {
    return view('stock.index');
})->name('stock');


Route::get('/kirimbarang', function () {
    return view('barangkeluar.create');
})->name('kirimbarang');


Route::get('/barangkeluar', function () {
    return view('barangkeluar.index');
})->name('barangkeluar');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// ini buat Actions
// Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
Route::get('/barangmasuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barangmasuk.index');
Route::get('/stock', [BarangMasukController::class, 'indexStock'])->name('stock.index');
Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
// Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');
Route::post('/barangmasuk/accept/{id}', [BarangMasukController::class, 'accept'])->name('barangmasuk.accept');
Route::get('/barangmasuk/{id}/details', [BarangMasukController::class, 'getDetails'])->name('barangmasuk.details');






require __DIR__.'/auth.php';
