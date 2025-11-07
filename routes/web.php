<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompressionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/compress', [CompressionController::class, 'index'])->name('compress.index');
// Route::post('/compress', [CompressionController::class, 'upload'])->name('compress.upload');

Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth'])
     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CompressionController::class, 'index'])->name('dashboard');
    Route::post('/compress/upload', [CompressionController::class, 'upload'])->name('compress.upload');
});


Route::get('/compress', [CompressionController::class, 'index'])->name('compress.index');
Route::post('/compress/upload', [CompressionController::class, 'upload'])->name('compress.upload');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


require __DIR__.'/auth.php';
