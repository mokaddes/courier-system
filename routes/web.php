<?php

use App\Http\Controllers\Admin\MerchantApikeyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// frontend
use App\Http\Controllers\HomeController;
// user
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\MerchantController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about-us', [HomeController::class, 'about'])->name('about');
Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');
Route::post('contact/submit', [HomeController::class, 'contactSub'])->name('contact.submit');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('ecommerce', [HomeController::class, 'ecommerce'])->name('ecommerce');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('Terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.onditions');
Route::get('tracking', [HomeController::class, 'tracking'])->name('tracking');
Route::get('pick-up-request', [HomeController::class, 'pickUpRequest'])->name('pickup.request');
Route::post('pick-up-request/submit', [HomeController::class, 'pickUpRequestSub'])->name('pickup.request.submit');
Route::get('/pickup-area', [HomeController::class, 'getPickupArea'])->name('getPickup-area');
Route::get('/delivery-area', [HomeController::class, 'getdeliveryArea'])->name('getdelivery-area');
Route::post('/delivery-cost', [HomeController::class, 'deliveryCost'])->name('deliveryCost');

Route::get('login/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.login.callback');
Route::get('api-document', [HomeController::class, 'document'])->name('merchant.api.document');

Auth::routes(['except' => ['login','password.reset']]);
// Route::get('password/reset/{token}/{email}/{broker}',[ResetPasswordController::class,'showResetForm'])->name('password.reset');



Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('/profile', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [DashboardController::class, 'setting'])->name('setting');
    Route::post('profile/update', [DashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/change-password', [DashboardController::class, 'passwordChange'])->name('password.change');
});


Route::prefix('/merchant')->name('merchant.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('register', [MerchantController::class, 'register'])->name('register');
    Route::post('register-store', [MerchantController::class, 'registerStore'])->name('register.store');
    Route::get('register-success', [MerchantController::class, 'registerSuccess'])->name('register.success');
});


