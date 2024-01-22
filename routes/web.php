<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAnggotaController;
use App\Http\Controllers\DetailDataAngsuranController;
use App\Http\Controllers\DetailDataPinjamanController;
use App\Http\Controllers\DetailDataSimpananController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LaporanAngsuranController;
use App\Http\Controllers\LaporanPinjamanController;
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

Route::middleware('auth')->group(function () {

    Route::get('/data_simpanan', [SavingController::class, 'index'])->name('datasimpanan');
    Route::post('/data_simpanan', [SavingController::class, 'store'])->name('storedatasimpanan');
    Route::get('/{id}/detail_datasimpanan', [DetailDataSimpananController::class, 'index'])->name('detail_datasimpanan');

    Route::get('/data_pinjaman', [CreditController::class, 'index'])->name('datapinjaman');
    Route::post('/data_pinjaman', [CreditController::class, 'store'])->name('storedatapinjaman');

    Route::get('/{id}/detail_datapinjaman', [DetailDataPinjamanController::class, 'index'])->name('detail_datapinjaman');
    Route::post('/{id}/detail_datapinjaman', [DetailDataPinjamanController::class, 'store_review'])->name('store_reviewpinjaman');

    Route::post('/{id}/store_angsuran_pinjaman', [InstallmentController::class, 'store_installment'])->name('store_dataangsuran');
    Route::get('/data_angsuran', [InstallmentController::class, 'index'])->name('dataangsuran');
    Route::get('/{id}/detail_dataangsuran', [DetailDataAngsuranController::class, 'index'])->name('detail_dataangsuran');

    Route::get('/data_anggota', [DataAnggotaController::class, 'index'])->name('dataanggota');
    Route::post('/data_anggota', [DataAnggotaController::class, 'store'])->name('storedataanggota');

    Route::get('/laporan_simpanan', [MonthlyReportController::class, 'index'])->name('laporan_simpanan');
    Route::get('/export_simpanan', [MonthlyReportController::class, 'exportPdf'])->name('export_simpanan');

    Route::get('/laporan_pinjaman', [LaporanPinjamanController::class, 'index'])->name('laporan_pinjaman');
    Route::get('/laporan_angsuran', [LaporanAngsuranController::class, 'index'])->name('laporan_angsuran');

});

require __DIR__ . '/auth.php';
