<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('guest')->group(function () {
    // Admin login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Resident login
    Route::get('resident-login', [AuthenticatedSessionController::class, 'residentCreate'])
        ->name('resident.login');
    Route::post('resident-login', [AuthenticatedSessionController::class, 'residentStore'])
        ->name('resident.login.store');

    // Socialite and other routes...
    Route::get('login/google', [AuthenticatedSessionController::class, 'GoogleLogin'])
        ->name('login.google');
    Route::get('/login/google/callback', [AuthenticatedSessionController::class, 'GoogleCallback']);
});

Route::middleware('auth')->group(function () {
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
