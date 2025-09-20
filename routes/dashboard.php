<?php

use App\Models\Clearance;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix("/dashboard")->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard', ['Clearance' => Clearance::all()]);
    })->name('dashboard');

    Route::get('/clearance', function () {
        return Inertia::render('Clearance', ['Clearance' => Clearance::all()]);
    })->name('clearance');

    Route::get('/accounts', function () {
        $pendingAccounts = User::where([
            ["role", "=", "Resident"],
            ["isVerified", "=", false]
        ])->get();

        return Inertia::render('Accounts', ['pendingUser' => $pendingAccounts]);
    })->name('accounts');
});
