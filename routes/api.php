<?php

use Fintech\Promo\Http\Controllers\PromotionController;
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

        Route::apiResource('promotions', PromotionController::class);
        Route::post('promotions/{promotion}/restore', [PromotionController::class, 'restore'])->name('promotions.restore');
        Route::get('promotions/promotional-types', [PromotionController::class, 'promotionType'])->name('promotions.promotional-types');

        //DO NOT REMOVE THIS LINE//
    });
}
