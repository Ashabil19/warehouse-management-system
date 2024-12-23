<?php 

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KirimBarangController;
use App\Http\Controllers\VendorController; 
use App\Http\Middleware\RoleMiddleware;

// Route Home
Route::get('/', function () { 
    return view('home'); 
})->name('home');

// Route Vendor tanpa middleware auth
Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');

// Routes with auth middleware
Route::middleware(['auth'])->group(function () {
    // Route untuk role 'purchasing'
    Route::middleware([RoleMiddleware::class . ':purchasing'])->group(function () {
        Route::get('/inputbarang', [BarangMasukController::class, 'create'])->name('inputbarang');
        Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
    });

    // Route untuk role 'logistik'
    Route::middleware([RoleMiddleware::class . ':purchasing'])->group(function () {
        Route::get('/barangmasuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barangmasuk.index');
        Route::get('/stock', [BarangMasukController::class, 'indexStock'])->name('stock.index');
        Route::get('/kirimbarang', [KirimBarangController::class, 'create'])->name('kirimbarang.create');
        Route::post('/kirimbarang', [KirimBarangController::class, 'store'])->name('kirimbarang.store');
        Route::get('/kirimbarang/export', [KirimBarangController::class, 'export'])->name('kirimbarang.export');
        
        Route::get('/barangmasuk/export', [BarangMasukController::class, 'exportBarangMasuk'])->name('barangmasuk.export');
        Route::get('/stock/export', [BarangMasukController::class, 'exportStock'])->name('stock.export');
        Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');
        Route::post('/barangmasuk/accept/{id}', [BarangMasukController::class, 'accept'])->name('barangmasuk.accept');
        Route::get('/barangmasuk/{id}/details', [BarangMasukController::class, 'getDetails'])->name('barangmasuk.details');
    });

    // Route untuk role 'sales'
    Route::middleware([RoleMiddleware::class . ':purchasing'])->group(function () {
        Route::get('/barangkeluar', [KirimBarangController::class, 'index'])->name('kirimbarang.index');
    });

    // Route Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Middleware untuk Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__.'/auth.php';
