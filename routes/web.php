<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TakmirController;
use App\Http\Controllers\KeuanganController;


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/display', [DisplayController::class, 'index'])->name('display');

Route::resource('pengumuman', PengumumanController::class);

Route::resource('kegiatan', KegiatanController::class);

Route::resource('keuangan', KeuanganController::class);

Route::resource('takmir', TakmirController::class);
