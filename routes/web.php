<?php 

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KirimBarangController;

// Route Home
Route::get('/', function () { 
    return view('home'); 
})->name('home');

// Route Input Barang
Route::get('/inputbarang', function () { 
    return view('barangmasuk.create'); 
})->name('inputbarang');

// Route Barang Masuk
Route::get('/barangmasuk/export', [BarangMasukController::class, 'exportBarangMasuk'])->name('barangmasuk.export');

Route::get('/barangmasuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barangmasuk.index');
Route::get('/stock', [BarangMasukController::class, 'indexStock'])->name('stock.index');
Route::get('/stock/export', [BarangMasukController::class, 'exportStock'])->name('stock.export');

Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');
Route::post('/barangmasuk/accept/{id}', [BarangMasukController::class, 'accept'])->name('barangmasuk.accept');
Route::get('/barangmasuk/{id}/details', [BarangMasukController::class, 'getDetails'])->name('barangmasuk.details');

// Route Kirim Barang (Create dan Store)
Route::get('/kirimbarang', [KirimBarangController::class, 'create'])->name('kirimbarang.create');
Route::post('/kirimbarang', [KirimBarangController::class, 'store'])->name('kirimbarang.store');
Route::get('/kirimbarang/export', [BarangMasukController::class, 'exportKirimBarang'])->name('kirimbarang.export');


// Route Barang Keluar (Index)
Route::get('/barangkeluar', [KirimBarangController::class, 'index'])->name('kirimbarang.index');
Route::get('/kirim-barang', [KirimBarangController::class, 'showAll'])->name('kirim-barang.showAll');

// Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware untuk Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__.'/auth.php';
