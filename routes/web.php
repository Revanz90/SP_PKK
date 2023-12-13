<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailDataAngsuranController;
use App\Http\Controllers\DetailDataPinjamanController;
use App\Http\Controllers\DetailDataSimpananController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\SavingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/dashboard', [DashboardController::class, 'hitungsurat'], function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('akun', [AkunController::class, 'akun'])->name('akun');
// Route::get('/daftar', [DaftarController::class, 'daftar'])->name('daftar');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/data_simpanan', [SavingController::class, 'index'])->name('datasimpanan');
    Route::post('/data_simpanan', [SavingController::class, 'store'])->name('storedatasimpanan');
    Route::get('/{id}/detail_datasimpanan', [DetailDataSimpananController::class, 'index'])->name('detail_datasimpanan');

    Route::get('/data_pinjaman', [CreditController::class, 'index'])->name('datapinjaman');
    Route::post('/data_pinjaman', [CreditController::class, 'store'])->name('storedatapinjaman');
    Route::get('/{id}/detail_datapinjaman', [DetailDataPinjamanController::class, 'index'])->name('detail_datapinjaman');
    Route::post('/{id}/detail_datapinjaman', [CreditController::class, 'storeInstallment'])->name('detail_datapinjaman');
    Route::post('/{id}/update-status', [CreditController::class, 'updatestatuscredit'])->name('creditstatus');

    Route::get('/data_angsuran', [InstallmentController::class, 'index'])->name('dataangsuran');
    Route::post('/data_angsuran', [InstallmentController::class, 'store'])->name('storedataangsuran');
    Route::get('/{id}/detail_dataangsuran', [DetailDataAngsuranController::class, 'index'])->name('detail_dataangsuran');

    Route::get('/monthly_report', [MonthlyReportController::class, 'monthly'])->name('laporan_bulanan');
});

require __DIR__ . '/auth.php';
