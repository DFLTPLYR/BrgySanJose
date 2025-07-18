<?php

use App\Http\Controllers\Service\BarangayClearance;
use App\Http\Controllers\Service\FencingClearance;
use App\Http\Controllers\Service\IndigencyClearance;
use App\Http\Controllers\Service\NewBusinessClearance;
use App\Http\Controllers\Service\RealEstateClearance;
use App\Http\Controllers\Service\RenewalClearance;
use App\Http\Controllers\Service\WaterElectricClearance;
use App\Http\Controllers\Service\WorkingClearance;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\PreventUnauthorizeEdit;
use Illuminate\Support\Facades\Route;

Route::prefix('/service')->group(function () {
    Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('clearance.destroy');

    Route::get('/barangay-clearance', [BarangayClearance::class, 'index'])->name('barangay-clearance')->middleware(PreventUnauthorizeEdit::class);
    Route::post('/barangay-clearance', [BarangayClearance::class, 'store'])->name('barangay-clearance-form');

    Route::get('/working-clearance', [WorkingClearance::class, 'index'])->name('working-clearance')->middleware(PreventUnauthorizeEdit::class);
    Route::post('/working-clearance', [WorkingClearance::class, 'store'])->name('working-clearance-form');

    Route::get('/water-electrical-permit', [WaterElectricClearance::class, 'index'])->name('water-electrical-permit')->middleware(PreventUnauthorizeEdit::class);
    Route::post('/water-electrical-permit', [WaterElectricClearance::class, 'store'])->name('water-electrical-permit-form');

    Route::get('/fencing-building-permit', [FencingClearance::class, 'index'])->name('fencing-building-permit')->middleware(PreventUnauthorizeEdit::class);
    Route::post('/fencing-building-permit', [FencingClearance::class, 'store'])->name('fencing-building-permit-form');

    Route::prefix('/business-clearance')->group(function () {
        // index
        Route::get('/', [ServiceController::class, 'Business'])->name('business-clearance');
        // new clearance
        Route::get('-new', [NewBusinessClearance::class, 'index'])->name('business-clearance-new')->middleware(PreventUnauthorizeEdit::class);
        Route::post('-new', [NewBusinessClearance::class, 'store'])->name('submit-business-clearance-new');
        // renewal
        Route::get('-renewal', [RenewalClearance::class, 'index'])->name('business-clearance-renewal')->middleware(PreventUnauthorizeEdit::class);
        Route::post('-renewal', [RenewalClearance::class, 'store'])->name('submit-business-clearance-renewal');
        // real estate
        Route::get('-forRealEstate', [RealEstateClearance::class, 'index'])->name('business-clearance-forrealestate')->middleware(PreventUnauthorizeEdit::class);
        Route::post('-forRealEstate', [RealEstateClearance::class, 'store'])->name('submit-business-clearance-forrealestate');
    });

    Route::get('/indigency-clearance', [IndigencyClearance::class, 'index'])->name('indigency-clearance')->middleware(PreventUnauthorizeEdit::class);
    Route::post('/indigency-clearance', [IndigencyClearance::class, 'store'])->name('indigency-clearance-form');

    Route::post('/sendMail', [ServiceController::class, 'sendMail'])->name("sendMail");

    Route::post('/sendMail', [ServiceController::class, 'sendMail'])->name("sendMail");
});
