<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DonationCategoryController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\DonationStatusController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\DonationController;
use App\Http\Controllers\Backend\DonationDetailsController;
use App\Http\Controllers\Backend\TermsController;
use App\Http\Controllers\Backend\QuantityController;
use App\Http\Controllers\RegionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'role:admin'])
     ->group(function (){
         Route::get('/', [DashboardController::class, 'index']);
         Route::resource('users', UserController::class);
         Route::resource('donationcategory', DonationCategoryController::class);
         Route::resource('role', RoleController::class);
         Route::resource('donationstatus', DonationStatusController::class);
         Route::get('members/get-members/{id}', [MemberController::class, 'getMembers'])->name('getMembers');
         Route::resource('members', MemberController::class);
         Route::post('donation/confirm/{id}', [DonationController::class, 'confirm'])->name('donation.confirm');
         Route::resource('donation', DonationController::class);
         Route::resource('terms', TermsController::class);
         Route::resource('quantity', QuantityController::class);
         Route::get('donation-detail/{id}', [DonationDetailsController::class, 'getDetails'])->name('donation-details');
         Route::get('food/{id}', [DonationDetailsController::class, 'getFood'])->name('get-foods');
         Route::get('food/create/{id}', [DonationDetailsController::class, 'createFood'])->name('create-food');
         Route::post('food/store', [DonationDetailsController::class, 'storeFood'])->name('store-food');
         Route::get('food/edit/{id}', [DonationDetailsController::class, 'editFood'])->name('edit-food');
         Route::put('food/update/{id}', [DonationDetailsController::class, 'updateFood'])->name('update-food');
         Route::delete('food/destroy/{donation_id}/{id}', [DonationDetailsController::class, 'destroyFood'])->name('delete-foods');
         Route::get('regions/province', [RegionController::class, 'getProvinces'])->name('province');
         Route::get('regions/cities/{id}', [RegionController::class, 'getCities'])->name('city');
         Route::get('regions/districts/{id}', [RegionController::class, 'getDistricts'])->name('district');
         Route::get('regions/villages/{id}', [RegionController::class, 'getVillages'])->name('village');
     });



require __DIR__.'/auth.php';
