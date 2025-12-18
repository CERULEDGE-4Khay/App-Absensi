<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RedirectController;
use App\Http\Controllers\MagangDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);


Route::get('/redirect', RedirectController::class)
    ->middleware('auth')
    ->name('redirect');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:magang'])->group(function () {
    Route::get('/dashboard/magang', [MagangDashboardController::class, 'index'])
        ->name('dashboard.magang');
    Route::post('/absen/masuk', [MagangDashboardController::class, 'absenMasuk'])
        ->name('absen.masuk');
    Route::post('/absen/keluar', [MagangDashboardController::class, 'absenKeluar'])
        ->name('absen.keluar');
    Route::get('/absensi/riwayat', [MagangDashboardController::class, 'riwayat'])
        ->name('absensi.riwayat');

});

Route::middleware(['auth','role:admin'])->group(function () {

    // DASHBOARD RINGKAS
    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])
        ->name('dashboard.admin');

    // HALAMAN DETAIL ABSENSI
    Route::get('/admin/absensi', [AdminAbsensiController::class, 'index'])
        ->name('admin.absensi');

});





require __DIR__.'/auth.php';
