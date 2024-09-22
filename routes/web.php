<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::middleware('auth')->group(function(){

    Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
    Route::get('/Profile', [ProfileController::class, 'edit'])->name('profile.edit');;
    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');
    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');
});




require __DIR__ . '/auth.php';
