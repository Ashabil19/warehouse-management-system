<?php    
    
use App\Http\Controllers\ProfileController;    
use Illuminate\Support\Facades\Route;    
use App\Http\Controllers\BarangMasukController;    
use App\Http\Controllers\KirimBarangController;    
use App\Http\Controllers\VendorController;    
use App\Http\Middleware\RoleMiddleware;    
use App\Exports\ExportsLogistik;    
use App\Exports\PurchasingStockExport; // Pastikan ini ada    
use Maatwebsite\Excel\Facades\Excel;    
use App\Http\Controllers\Auth\AuthenticatedSessionController;    
    
// Route Home    
Route::get('/', function () {    
    return view('home');    
})->name('home');    
    
// Routes for Auth    
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');    
Route::post('/login', [AuthenticatedSessionController::class, 'store']);    
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');    
    
// Routes with auth middleware    
Route::middleware(['auth'])->group(function () {    
    // Route untuk role 'purchasing'    
    Route::middleware([RoleMiddleware::class . ':purchasing'])->group(function () {    
        Route::get('/inputbarang', [BarangMasukController::class, 'create'])->name('inputbarang');    
        Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');    
    
        // Route untuk ekspor stok untuk purchasing    
        Route::get('/export-purchasing-stock', [BarangMasukController::class, 'exportPurchasingStock'])->name('exports.purchasing');    
    
        // Route Vendor tanpa middleware auth    
        Route::prefix('vendor')->group(function () {    
            Route::get('/', [VendorController::class, 'index'])->name('vendor.index');    
            Route::get('/create', [VendorController::class, 'create'])->name('vendor.create');    
            Route::post('/', [VendorController::class, 'store'])->name('vendor.store');    
            Route::get('/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');    
            Route::put('/{id}', [VendorController::class, 'update'])->name('vendor.update');    
            Route::delete('/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');    
        });    
    });    
    
    Route::get('/barangmasuk/export', [BarangMasukController::class, 'exportBarangMasuk'])->name('barangmasuk.export');    
    
    // Route untuk role 'logistik' dan 'purchasing' untuk akses stock    
    Route::middleware([RoleMiddleware::class . ':logistik,purchasing'])->group(function () {    
        Route::get('/barangmasuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barangmasuk.index');    
        Route::get('/barangmasuk/{id}', [BarangMasukController::class, 'show'])->name('barangmasuk.show');    
        Route::post('/barangmasuk/{id}/reject', [BarangMasukController::class, 'reject'])->name('barangmasuk.reject');    
        Route::post('/barangmasuk/accept/{id}', [BarangMasukController::class, 'accept'])->name('barangmasuk.accept');    
        Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');    
    
        // Route untuk akses stock    
        Route::get('/stock', [BarangMasukController::class, 'indexStock'])->name('stock.index');    
        Route::get('stock/export', [App\Http\Controllers\BarangMasukController::class, 'exportStock'])->name('stock.export');    
    });    
    
    // Route untuk role 'sales'    
    Route::middleware([RoleMiddleware::class . ':logistik'])->group(function () {    
        Route::get('/barangkeluar', [KirimBarangController::class, 'index'])->name('barangkeluar.index');    
    });    
    
    // Route untuk role 'logistik'    
    Route::middleware([RoleMiddleware::class . ':logistik'])->group(function () {    
        Route::get('/kirimbarang', [KirimBarangController::class, 'create'])->name('kirimbarang.create');    
        Route::post('/kirimbarang', [KirimBarangController::class, 'store'])->name('kirimbarang.store');    
        Route::get('/kirimbarang/export', [KirimBarangController::class, 'export'])->name('kirimbarang.export');    
        Route::patch('/kirimbarang/{id}/update-link-resi', [KirimBarangController::class, 'updateLinkResi'])->name('kirimbarang.updateLinkResi');    
    });    
    
    // Route Dashboard    
    Route::get('/dashboard', function () {    
        return view('dashboard');    
    })->middleware(['verified'])->name('dashboard');    
    
    // Middleware untuk Profile    
    Route::prefix('profile')->group(function () {    
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');    
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');    
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');    
    });    
    
    // Route untuk export logistik    
    Route::get('/exports/logistik', function () {    
        return Excel::download(new ExportsLogistik, 'barang_masuk_logistik.xlsx');    
    })->name('exports.logistik');    
});    
    
// Auth Routes    
require __DIR__.'/auth.php';    
