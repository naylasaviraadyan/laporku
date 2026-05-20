<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // LAPORAN
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan');
    Route::post('/laporan', [ReportController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/create', function () {
        return view('laporan.create');
    })->name('laporan.create');

    // PROFIL
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');

    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profil.update');

    // LAINNYA
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])
        ->name('notifikasi');

    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');
    Route::get('/laporan/{id}', [ReportController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}', [ReportController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{id}/status', [ReportController::class, 'status'])->name('laporan.status');
    Route::post('/laporan/{id}/batal', [ReportController::class, 'batal'])->name('laporan.batal');
    Route::post('/laporan/{id}/update/{status}', [ReportController::class, 'updateStatus']);
    Route::get('/laporan/{id}/rating', [ReportController::class, 'ratingForm'])->name('laporan.rating');
    Route::post('/laporan/{id}/rating', [ReportController::class, 'ratingStore'])->name('laporan.rating.store');
    Route::get('/notifikasi/{id}', [NotifikasiController::class, 'show'])
        ->name('notifikasi.show');
    Route::get('/profile', function () {
        return redirect('/profil');
    })->name('profile.edit');
    Route::post('/laporan/{id}/update', [DashboardController::class, 'updateStatus']);
    Route::post(
        '/laporan/{id}/update/{status}',
        [ReportController::class, 'updateStatus']
    );
});
// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::post(
        '/admin/update-status/{id}',
        [AdminController::class, 'updateStatus']
    )
        ->name('admin.updateStatus');
    Route::get('/admin/laporan/{id}', [AdminController::class, 'show'])
        ->name('admin.laporan.show');
    Route::get('/admin/pengguna', [DashboardController::class, 'pengguna']);
    Route::get('/admin/laporan', [DashboardController::class, 'laporanAdmin']);
});
