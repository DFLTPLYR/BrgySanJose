<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/service.php';
require __DIR__.'/dashboard.php';
