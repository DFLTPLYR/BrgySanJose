<?php

use App\Http\Controllers\ServiceController;
use App\Http\Requests\TestFormRequest;
use Illuminate\Support\Facades\Request;
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

Route::prefix('/services')->group(function (){
    Route::get('/barangay-clearance', [ServiceController::class, 'Barangay'])->name('barangay-clearance');
    Route::post('/barangay-clearance', [ServiceController::class, 'SubmitClearanceForm'])->name('barangay-clearance-form');

    Route::get('/working-clearance', [ServiceController::class, 'Working'])->name('working-clearance');
    Route::get('/water-electrical-permit', [ServiceController::class, 'WaterElectrical'])->name('water-electrical-permit');
    Route::get('/fencing-building-permit', [ServiceController::class, 'FenceBuilding'])->name('fencing-building-permit');
    Route::get('/business-clearance', [ServiceController::class, 'Business'])->name('business-clearance');
    Route::get('/indigency-clearance', [ServiceController::class, 'Indigency'])->name('indigency-clearance');
});

Route::post('/test', function (Request $request) {
    dd($request->all());
})->name('test');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
