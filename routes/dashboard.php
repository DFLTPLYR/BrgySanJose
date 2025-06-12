<?php

use App\Models\Clearance;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    // dd(Clearance::all());
    return Inertia::render('Dashboard', ['Clearance' => Clearance::all()]);
})->name('dashboard');
