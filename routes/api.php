<?php

use App\Http\Controllers\Api\AccountsController;
use App\Http\Controllers\Api\DelivaryBoy\LoginController;
use App\Http\Controllers\Api\DelivaryBoy\OrderController as DeliveryBoyOrderController;
use App\Http\Controllers\Api\DelivaryBoy\ProfileController as DeliveryBoyProfileController;
use App\Http\Controllers\Api\PickupRequestController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\DeliveryMan\Api\AddressController;
use App\Http\Controllers\DeliveryMan\Api\AuthController;
use App\Http\Controllers\DeliveryMan\Api\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('delivery-man')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        //        Route::get('/', [DashboardController::class, 'index']);
        //        Route::get('/profile', [ProfileController::class, 'index']);
        //        Route::post('/profile-update', [ProfileController::class, 'update']);
        Route::post('/password-update', [ProfileController::class, 'passwordUpdate']);
        Route::post('/account-delete', [ProfileController::class, 'accountDelete']);
        //        Route::get('/all/order', [OrderController::class, 'allOrder']);
        //        Route::get('/pending/order', [OrderController::class, 'pendingOrder']);
        //        Route::get('/onTheWay/order', [OrderController::class, 'onTheWayOrder']);
        //        Route::get('/delivered/order', [OrderController::class, 'deliveredOrder']);
        //        Route::get('/pickup/order', [OrderController::class, 'pickupdOrder']);
        //        Route::get('/confirmed/order', [OrderController::class, 'confirmedOrder']);
        //        Route::get('/cancel/order', [OrderController::class, 'cancelOrder']);
        //        Route::get('/cash-on-delivery', [OrderController::class, 'cashOnDelivery']);
        //        Route::get('/order/view', [OrderController::class, 'view']);
        //        Route::post('/update-order-status', [OrderController::class, 'updateOrderStatus']);
        //        Route::get('/cod/order/{id}/view', [OrderController::class, 'codView']);
        //        Route::post('/cod/update-order-status/', [OrderController::class, 'codUpdateOrderStatus']);
    });
});
Route::get('/country', [AddressController::class, 'country']);
Route::post('/city-by-state', [AddressController::class, 'cityByState']);
Route::post('/state-by-country', [AddressController::class, 'stateByCountry']);


Route::get('/service-cities', [PickupRequestController::class, 'serviceCities']);
Route::post('/pickup/request', [PickupRequestController::class, 'index']);
//Route::post('/pickup/request', [PickupRequestController::class, 'apiCheck']);
//Route::get('/pickup/request/create/{id}', [PickupRequestController::class, 'create']);
//Route::post('/pickup/request/store', [PickupRequestController::class, 'store']);
Route::post('/pickup/request/submit', [PickupRequestController::class, 'submit']);


Route::post('send-otp',[ResetPasswordController::class,'sendOtp']);
Route::post('otp-verify',[ResetPasswordController::class,'otpVerify']);
Route::post('reset-password',[ResetPasswordController::class,'resetPassword']);
Route::get('setting',[SettingController::class,'index']);

Route::prefix('delivery-boy')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [LoginController::class, 'login']);
    });
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('pickup-request-list', [DeliveryBoyOrderController::class, 'index']);
        Route::get('/pickup-request/view/{pickupRequest}', [DeliveryBoyOrderController::class, 'view']);
        Route::post('/pickup-request/status/{pickupRequest}', [DeliveryBoyOrderController::class, 'status']);

            Route::get('/waiting-list',[DeliveryBoyOrderController::class,'waitingList']);
            Route::post('approved/waiting-list',[DeliveryBoyOrderController::class,'approvedRequest']);

        Route::get('/profile', [DeliveryBoyProfileController::class, 'index']);
        Route::post('/profile-update', [DeliveryBoyProfileController::class, 'update']);
        Route::post('/password-update', [DeliveryBoyProfileController::class, 'passwordUpdate']);
        Route::post('/account-delete', [DeliveryBoyProfileController::class, 'accountDelete']);
        Route::get('account/due', [AccountsController::class, 'deuAccounts']);
    });
});
