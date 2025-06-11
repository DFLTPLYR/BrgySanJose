<?php

use App\Http\Controllers\ServiceController;
use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/log-in', function () {
    return Inertia::render('LogIn');
})->name('log-in');

Route::post('/sign-in', function (Request $request) {
    $request->validateWithBag('signInErrorBag', [
        'username' => [],
    ]);
})->name('sign-in');

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::prefix('/services')->group(function () {
    Route::get('/barangay-clearance', [ServiceController::class, 'Barangay'])->name('barangay-clearance');
    Route::post('/barangay-clearance', [ServiceController::class, 'SubmitClearanceForm'])->name('barangay-clearance-form');

    Route::get('/working-clearance', [ServiceController::class, 'Working'])->name('working-clearance');
    Route::post('/working-clearance', [ServiceController::class, 'SubmitWorkingForm'])->name('working-clearance-form');

    Route::get('/water-electrical-permit', [ServiceController::class, 'WaterElectrical'])->name('water-electrical-permit');
    Route::post('/water-electrical-permit', [ServiceController::class, 'SubmitWaterElectricalForm'])->name('water-electrical-permit-form');

    Route::get('/fencing-building-permit', [ServiceController::class, 'FenceBuilding'])->name('fencing-building-permit');
    Route::post('/fencing-building-permit', [ServiceController::class, 'SubmitFenceBuildingForm'])->name('fencing-building-permit-form');

    Route::prefix('/business-clearance')->group(function () {
        // index
        Route::get('/', [ServiceController::class, 'Business'])->name('business-clearance');
        // new clearance
        Route::get('-new', [ServiceController::class, 'BusinessNew'])->name('business-clearance-new');
        Route::post('-new', [ServiceController::class, 'SubmitFormBusinessNew'])->name('submit-business-clearance-new');
        // renewal
        Route::get('-renewal', [ServiceController::class, 'BusinessRenewal'])->name('business-clearance-renewal');
        Route::post('-renewal', [ServiceController::class, 'SubmitFormBusinessRenewal'])->name('submit-business-clearance-renewal');
        // real estate
        Route::get('-forRealEstate', [ServiceController::class, 'BusinessForRealEstate'])->name('business-clearance-forrealestate');
        Route::post('-forRealEstate', [ServiceController::class, 'SubmitFormBusinessForRealEstate'])->name('submit-business-clearance-forrealestate');
    });

    Route::get('/indigency-clearance', [ServiceController::class, 'Indigency'])->name('indigency-clearance');
    Route::post('/indigency-clearance', [ServiceController::class, 'SubmitIndigencyForm'])->name('indigency-clearance-form');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
