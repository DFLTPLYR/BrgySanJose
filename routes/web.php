<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ClearanceController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/news-and-events', function () {
    return Inertia::render('NewsAndEvents');
})->name('news-and-events');

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');


Route::put('/clearance/{clearance}/status', [ClearanceController::class, 'updateStatus'])->name('clearance.updateStatus');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/service.php';
require __DIR__.'/dashboard.php';
