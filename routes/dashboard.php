<?php

use App\Models\Clearance;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', ['Clearance' => Clearance::all()]);
})->name('dashboard');
