<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUsersController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\VehicleCategoryController as AdminVehicleCategoryController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\LostAndFoundController as AdminLostAndFoundController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\Admin\VoucherCategoryController as AdminVoucherCategoryController;
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\Front\LandingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
});



Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',

])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUsersController::class);
    Route::resource('drivers', AdminDriverController::class);
    Route::resource('transactions', AdminTransactionController::class);
    Route::resource('lostAndFounds', AdminLostAndFoundController::class);
    Route::resource('vehicleCategories', AdminVehicleCategoryController::class);
    Route::resource('vehicles', AdminVehicleController::class);
    Route::resource('ratings', AdminRatingController::class);
    Route::resource('voucherCategories', AdminVoucherCategoryController::class);
    Route::resource('vehicleCategories', AdminVehicleCategoryController::class);
    Route::resource('ratings', AdminRatingController::class);
    Route::resource('transactions', AdminTransactionController::class);
    Route::resource('vouchers', AdminVoucherController::class);
});