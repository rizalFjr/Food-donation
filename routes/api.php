<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DonationCategoryController;
use App\Http\Controllers\API\QuantityController;
use App\Http\Controllers\API\DonationStatusController;
use App\Http\Controllers\API\TermsController;
use App\Http\Controllers\API\DonationController;
use App\Http\Controllers\API\DonationDetailsController;
use App\Http\Controllers\API\DonationHistoryController;
use App\Http\Controllers\API\DonationItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->group(function () {
        Route::get('regions/province', [RegionController::class, 'getProvinces'] )->name('province');
        Route::get('regions/cities/{id}', [RegionController::class, 'getCities'] )->name('city');
        Route::get('regions/districts/{id}', [RegionController::class, 'getDistricts'] )->name('district');
        Route::get('regions/villages/{id}', [RegionController::class, 'getVillages'] )->name('village');
        Route::get('terms', [TermsController::class, 'getTerms']);

        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::middleware(['auth:sanctum'])
                ->group(function () {
                    // Auth API
                    Route::post('logout', [AuthController::class, 'logout']);

                    // Member API
                    Route::get('fetch-profile', [AuthController::class, 'fetchUser']);
                    Route::post('update-profile', [AuthController::class, 'updateProfile']);
                    Route::post('update-photo', [AuthController::class, 'updatePhoto']);

                    Route::get('quantity', [QuantityController::class, 'getQuantity']);
                    Route::get('donation-status', [DonationStatusController::class, 'getDonationStatus']);
                    Route::get('donation-category', [DonationCategoryController::class, 'getDonationCategory']);

                    Route::post('donation', [DonationController::class, 'storeDonation']);
                    Route::get('donation-details/{id}', [DonationDetailsController::class, 'getDonationdetails']);
                    Route::get('donation-histories', [DonationHistoryController::class, 'getDonationhistory']);
                    Route::post('cancel-donation', [DonationController::class, 'cancelDonation']);


                    // Cart item API
                    Route::post('store-item', [DonationItemsController::class, 'storeCart']);
                    Route::get('get-cart-item', [DonationItemsController::class, 'getCart']);
                    Route::delete('remove-item', [DonationItemsController::class, 'removeItem']);
                });
    });
