<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/
if (Config::get('fintech.promo.enabled')) {
    Route::prefix('promo')->name('promo.')->group(function () {

        Route::apiResource('promotions', \Fintech\Promo\Http\Controllers\PromotionController::class);
        Route::post('promotions/{promotion}/restore', [\Fintech\Promo\Http\Controllers\PromotionController::class, 'restore'])->name('promotions.restore');

        //DO NOT REMOVE THIS LINE//
    });
}
