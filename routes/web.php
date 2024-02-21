<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\CatalogueController;
use App\Http\Controllers\Front\UpdateProfileController;
use App\Http\Controllers\Front\VehicleDetailController;
use App\Http\Controllers\Front\LostandFoundViewController;
use App\Http\Controllers\Admin\UserController as AdminUsersController;
use App\Http\Controllers\Front\OrderController as FrontOrderController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\Front\VoucherController as FrontVoucherController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\LostAndFoundController as AdminLostAndFoundController;
use App\Http\Controllers\Admin\VehicleCategoryController as AdminVehicleCategoryController;
use App\Http\Controllers\Admin\VoucherCategoryController as AdminVoucherCategoryController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PaymentController;

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
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}/update', [UpdateProfileController::class, 'updateProfile'])->name('profile.update-info');
    Route::put('/profile/{id}/update/driver', [UpdateProfileController::class, 'updateDrivingLicense'])->name('profile.update-driver');
    Route::get('/catalogue', [CatalogueController::class, 'index'])->name('indexCatalogue');
    Route::get('/vehicleDetail/{slug}', [VehicleDetailController::class, 'show'])->name('detailCatalogue');
    Route::get('/lostandfound', [LostandFoundViewController::class, 'index'])->name('lostandfound');
    Route::get('/orders', [FrontOrderController::class, 'index'])->name('order');
    Route::get('/orders/{id}', [FrontOrderController::class, 'show'])->name('orderDetail');
    Route::get('/voucher', [FrontVoucherController::class, 'index'])->name('voucher');
    Route::post('/vouchers/{id}', [FrontVoucherController::class, 'create'])->name('createVoucher');
    Route::post('/orders/extend/{id}', [FrontOrderController::class, 'extend'])->name('extendOrder');

    Route::group(['middleware' =>'auth'] , function(){
        Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.store');

        Route::get('/payment/success',[PaymentController::class, 'success'])->name('payment.success');
        Route::get('/payment/{transactionId}', [PaymentController::class, 'index'])->name('payment');
        Route::post('/payment/{transactionId}', [PaymentController::class, 'update'])->name('payment.update');
    });
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
