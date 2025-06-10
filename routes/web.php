<?php

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DisplayController;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/display', [DisplayController::class, 'show'])->name('display');
