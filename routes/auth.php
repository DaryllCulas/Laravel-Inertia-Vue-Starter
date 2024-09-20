<?php
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    // -------------- Register ------------------//

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // -------------- Login ------------------//
    Route::get('/login', [AuthenticateController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'store']);


    // -------------- Request Password Reset Link ------------------//

    route::get('/forgot-password', [ResetPasswordController::class, 'request'])->name('password.request');


      // -------------- Validating the Email and sending the password reset ------------------//

    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');



    // -------------- Reset Password ------------------//
    route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');


    // -------------- Updating the Password ------------------//

    Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');


});

Route::middleware('auth')->group(function () {

    // -------------- Logout ------------------//
    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');

    // -------------- Verify Email ------------------//
    route::get('/email/verify', [EmailVerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

    // -------------- Handle Email ------------------//
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])
    ->middleware('signed')
    ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware('throttle:6,1')
    ->name('verification.send');



    // -------------- Confirm Password ------------------//
    route::get('/confirm-password', [ConfirmPasswordController::class, 'create'])->name('password.confirm');


    Route::post('/confirm-password', [ConfirmPasswordController::class, 'store'
    ])->middleware('throttle:6,1');


});
