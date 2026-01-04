<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RedirectController;
use App\Http\Controllers\MagangDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\MagangController;

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

    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/users/create', [AdminUserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/admin/users', [AdminUserController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::post('/admin/laporan/generate', [LaporanController::class, 'generate'])->name('admin.laporan.generate');

    Route::get('/peserta-magang', [MagangController::class, 'index'])->name('admin.magang.index');
    Route::patch('/peserta-magang/{magang}/status', [MagangController::class, 'updateStatus'])->name('admin.magang.update-status');

    Route::get('/admin/laporan/preview', [LaporanController::class, 'preview'])->name('admin.laporan.preview');
});





require __DIR__.'/auth.php';
