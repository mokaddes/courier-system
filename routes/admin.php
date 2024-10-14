<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryManController;
use App\Http\Controllers\Admin\EcommerceServiceController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MerchantApikeyController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\MerchantRequest;
use App\Http\Controllers\Admin\MerchantTransactionController;
use App\Http\Controllers\Admin\OurServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\PriceGroupController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\WeightController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PickupRequestController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Admin\PriceController;

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

// Admin Authentication
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login.admin');
Route::get('deliveryman/login', [LoginController::class, 'showLoginForm'])->name('login.deliveryman');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin'], 'where' => ['locale' => '[a-zA-Z]{2}']], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/test-mail', [DashboardController::class, 'testMail'])->name('test.mail');
    Route::get('/cc', [DashboardController::class, 'cacheClear'])->name('cacheClear');
    // settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('general', [SettingsController::class, 'general'])->name('general');
        Route::post('general/store', [SettingsController::class, 'generalStore'])->name('general_store');
        Route::get('smtp', [SettingsController::class, 'mailview'])->name('smtp.mail');
        Route::get('languages', [LanguageController::class, 'index'])->name('language');
        Route::get('currency', [CurrencyController::class, 'currenview'])->name('currency.index');
    });


    Route::prefix('/price')->name('price.')->group(function () {
        Route::get('/index/{price_group?}', [PriceController::class, 'index'])->name('index');
        Route::get('/create', [PriceController::class, 'create'])->name('create');
        Route::post('/store', [PriceController::class, 'store'])->name('store');
        Route::get('/edit/{price}', [PriceController::class, 'edit'])->name('edit');
        Route::post('/update/{price}', [PriceController::class, 'update'])->name('update');
        Route::get('/delete/{price}', [PriceController::class, 'destroy'])->name('delete');
        Route::post('/status', [PriceController::class, 'status'])->name('status');
    });
    Route::prefix('/price-group')->name('price-group.')->group(function () {

        Route::get('/', [PriceGroupController::class, 'index'])->name('index');
        Route::get('/create', [PriceGroupController::class, 'create'])->name('create');
        Route::post('/store', [PriceGroupController::class, 'store'])->name('store');
        Route::get('/edit/{price_group}', [PriceGroupController::class, 'edit'])->name('edit');
        Route::post('/update/{price_group}', [PriceGroupController::class, 'update'])->name('update');
        Route::get('/delete/{price_group}', [PriceGroupController::class, 'destroy'])->name('delete');
        Route::post('/status', [PriceGroupController::class, 'status'])->name('status');
    });


    //Faq
    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('create', [FaqController::class, 'create'])->name('create');
        Route::post('store', [FaqController::class, 'store'])->name('store');
        Route::get('{id}/view', [FaqController::class, 'view'])->name('view');
        Route::get('{id}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [FaqController::class, 'update'])->name('update');
        Route::get('delete', [FaqController::class, 'delete'])->name('delete');
    });


    Route::prefix('accounts')->name('accounts.')->group(function () {
        Route::get('due', [AccountsController::class, 'deuAccounts'])->name('due');
        Route::get('/{id}/duereceive', [AccountsController::class, 'dueReceive'])->name('duereceive');
    });

    //Pickup Request
    Route::group(['prefix' => 'pickup-request', 'as' => 'pickup-request.'], function () {
        Route::get('/', [PickupRequestController::class, 'index'])->name('index');
        Route::get('create', [PickupRequestController::class, 'create'])->name('create');
        Route::post('store', [PickupRequestController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PickupRequestController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [PickupRequestController::class, 'update'])->name('update');
        Route::get('{id}/view', [PickupRequestController::class, 'view'])->name('view');
        Route::get('status/active/{id}', [PickupRequestController::class, 'active'])->name('status.active');
        Route::get('status/change/{id}/{status}', [PickupRequestController::class, 'changeStatus'])->name('status.change');
        Route::get('delete/{id}', [PickupRequestController::class, 'delete'])->name('delete');
        Route::post('assign/deliveryman', [PickupRequestController::class, 'assignDeliveryman'])->name('assign.deliveryman');
        Route::get('merchant/payment/{id}', [PickupRequestController::class, 'merchantPayment'])->name('merchant.payment');
        Route::get('pending-request', [PickupRequestController::class, 'pendingRequest'])->name('pending.deliveryman');
        Route::get('total-request', [PickupRequestController::class, 'totalRequest'])->name('total.deliveryman');
        Route::get('approve-pending-request/{id}', [PickupRequestController::class, 'approvePendingReq'])->name('approve');
        Route::get('pdelivery-request/delete/{id}', [PickupRequestController::class, 'pdeliveryReqDelete'])->name('pdelivery.delete');
        Route::get('pdelivery-request/view/{id}', [PickupRequestController::class, 'pDeliveryView'])->name('pdeliveryView');
    });
    // Setting
    Route::get('pages', [SettingsController::class, 'pages'])->name('pages');
    Route::get('page/{home}', [SettingsController::class, 'editHomePage'])->name('edit.home');
    Route::post('page/{home}/update', [SettingsController::class, 'updateHomePage'])->name('update.home');
    // settings
    Route::get('settings', [SettingsController::class, 'settings'])->name('settings');
    Route::post('change-settings', [SettingsController::class, 'changeSettings'])->name('change.settings');
    Route::get('tax-setting', [SettingsController::class, 'taxSetting'])->name('tax.setting');
    Route::post('update-tex-setting', [SettingsController::class, 'updateTaxSetting'])->name('update.tax.setting');
    Route::post('update-email-setting', [SettingsController::class, 'updateEmailSetting'])->name('update.email.setting');
    Route::post('test-email', [SettingsController::class, 'testEmail'])->name('test.email');
    // Users
    Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RolesController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/show', [RolesController::class, 'show'])->name('roles.show');
    Route::get('roles/{id}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::post('roles/{id}/update', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('roles/{id}/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
    // permissions
    Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
    Route::post('permissions/store', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/show', [PermissionsController::class, 'show'])->name('permissions.show');
    Route::get('permissions/{id}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/{id}/update', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::post('permissions/{id}/destroy', [PermissionsController::class, 'destroy'])->name('permissions.destroy');

    //Admins
    Route::get('user', [AdminController::class, 'index'])->name('user.index');
    Route::get('user/create', [AdminController::class, 'create'])->name('user.create');
    Route::post('user/store', [AdminController::class, 'store'])->name('user.store');
    Route::get('user/{id}/show', [AdminController::class, 'show'])->name('user.show');
    Route::get('user/{id}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::post('user/{id}/update', [AdminController::class, 'update'])->name('user.update');
    Route::get('user/{id}/destroy', [AdminController::class, 'destroy'])->name('user.destroy');

    //merchant
    Route::get('merchant', [MerchantController::class, 'index'])->name('merchant.index');
    Route::get('merchant/create', [MerchantController::class, 'create'])->name('merchant.create');
    Route::post('merchant/store', [MerchantController::class, 'store'])->name('merchant.store');
    Route::get('merchant/{id}/show', [MerchantController::class, 'show'])->name('merchant.show');
    Route::get('merchant/{id}/edit', [MerchantController::class, 'edit'])->name('merchant.edit');
    Route::post('merchant/{id}/update', [MerchantController::class, 'update'])->name('merchant.update');
    Route::get('merchant/{id}/destroy', [MerchantController::class, 'destroy'])->name('merchant.destroy');
    Route::post('merchant/bonus', [MerchantController::class, 'bonus'])->name('merchant.bonus');


    Route::get('api-keys/live', [MerchantApikeyController::class, 'live'])->name('merchant.apikey.live');
    Route::get('api-keys/demo', [MerchantApikeyController::class, 'demo'])->name('merchant.apikey.demo');
    Route::post('api-keys/store', [MerchantApikeyController::class, 'store'])->name('merchantapi.store');


    //Merchant Transaction
    Route::get('merchant-transaction', [MerchantTransactionController::class, 'index'])->name('merchant.transaction.index');
    Route::get('merchant-recharge', [MerchantTransactionController::class, 'create'])->name('merchant.recharge.create');
    Route::post('merchant-recharge/store', [MerchantTransactionController::class, 'store'])->name('merchant.recharge.store');
    Route::get('merchant-recharge/edit/{id}', [MerchantTransactionController::class, 'edit'])->name('merchant.recharge.edit');
    Route::post('merchant-recharge/update/{id}', [MerchantTransactionController::class, 'update'])->name('merchant.recharge.update');
    Route::get('merchant-recharge/delete/{id}', [MerchantTransactionController::class, 'delete'])->name('merchant.recharge.delete');
    Route::get('merchant-recharge/request', [MerchantTransactionController::class, 'rechargeRequest'])->name('merchant.recharge.request');
    Route::get('recharge-request/status/{id}', [MerchantTransactionController::class, 'status'])->name('merchant.recharge.request.status');
    Route::get('merchant-transaction/delete/{id}', [MerchantTransactionController::class, 'transactionDelete'])->name('merchant.transaction.delete');

//    Payment
    Route::get('edahab/pay', [PaymentController::class, 'edahabPay'])->name('edahab.pay');
    Route::post('edahab/confirm', [PaymentController::class, 'edahabConfirm'])->name('edahab.confirm');
    Route::post('zaad/pay', [PaymentController::class, 'zaadPay'])->name('zaad.pay');

    //delivery_man
    Route::get('deliveryman', [DeliveryManController::class, 'index'])->name('deliveryman.index');
    Route::get('deliveryman/create', [DeliveryManController::class, 'create'])->name('deliveryman.create');
    Route::post('deliveryman/store', [DeliveryManController::class, 'store'])->name('deliveryman.store');
    Route::get('deliveryman/{id}/show', [DeliveryManController::class, 'show'])->name('deliveryman.show');
    Route::get('deliveryman/{id}/edit', [DeliveryManController::class, 'edit'])->name('deliveryman.edit');
    Route::post('deliveryman/{id}/update', [DeliveryManController::class, 'update'])->name('deliveryman.update');
    Route::get('deliveryman/{id}/destroy', [DeliveryManController::class, 'destroy'])->name('deliveryman.destroy');
    Route::get('deliveryman/{id}/accounts', [DeliveryManController::class, 'accounts'])->name('deliveryman.accounts');


    Route::prefix('merchant-request')->name('merchant-request.')->group(function () {
        Route::get('index', [MerchantRequest::class, 'index'])->name('index');
        Route::get('view/{merchant_request}', [MerchantRequest::class, 'show'])->name('show');
        Route::post('approved/{merchant_request}', [MerchantRequest::class, 'approved'])->name('approved');
    });

    // Customers
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('create', [CustomerController::class, 'create'])->name('create');
        Route::post('store', [CustomerController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [CustomerController::class, 'update'])->name('update');
        Route::get('{id}/view', [CustomerController::class, 'view'])->name('view');
        Route::get('{id}/delete', [CustomerController::class, 'delete'])->name('delete');
    });
    // // location
    // Route::group(['prefix' => 'locations', 'as' => 'location.'], function () {
    //     Route::get('/', [LocationController::class, 'index'])->name('index');
    //     Route::get('create', [LocationController::class, 'create'])->name('create');
    //     Route::post('store', [LocationController::class, 'store'])->name('store');
    //     Route::get('edit/{slug}', [LocationController::class, 'edit'])->name('edit');
    //     Route::post('update/{slug}', [LocationController::class, 'update'])->name('update');
    //     Route::get('delete', [LocationController::class, 'delete'])->name('delete');
    // });
    // admin profile
    Route::get('profile', [DashboardController::class, 'adminProfile'])->name('profile');
    Route::post('profile/update/{id}', [DashboardController::class, 'adminProfileUpdate'])->name('profile.update');
    Route::post('password/update/{id}', [DashboardController::class, 'adminPasswordUpdate'])->name('password.update');
    //Contact
    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('{id}/view', [ContactController::class, 'view'])->name('view');
        Route::get('{id}/delete', [ContactController::class, 'delete'])->name('delete');
    });
    //Country
    Route::group(['prefix' => 'country', 'as' => 'country.'], function () {
        Route::get('/', [CountryController::class, 'index'])->name('index');
        Route::post('store', [CountryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CountryController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [CountryController::class, 'update'])->name('update');
        Route::get('{id}/delete', [CountryController::class, 'delete'])->name('delete');
    });
    //Region
    Route::group(['prefix' => 'region', 'as' => 'region.'], function () {
        Route::get('/', [RegionController::class, 'index'])->name('index');
        Route::post('store', [RegionController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RegionController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [RegionController::class, 'update'])->name('update');
        Route::get('{id}/delete', [RegionController::class, 'delete'])->name('delete');
    });
    //City
    Route::group(['prefix' => 'cities', 'as' => 'cities.'], function () {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::post('store', [CityController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CityController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [CityController::class, 'update'])->name('update');
        Route::get('{id}/delete', [CityController::class, 'delete'])->name('delete');
    });

    //Weight
    Route::group(['prefix' => 'weights', 'as' => 'weights.'], function () {
        Route::get('/', [WeightController::class, 'index'])->name('index');
        Route::post('store', [WeightController::class, 'store'])->name('store');
        Route::get('{id}/edit', [WeightController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [WeightController::class, 'update'])->name('update');
        Route::get('{id}/delete', [WeightController::class, 'delete'])->name('delete');
    });
    //seo
    Route::group(['prefix' => 'seo', 'as' => 'seo.'], function () {
        Route::get('/', [SeoController::class, 'index'])->name('index');
        Route::get('{id}/edit', [SeoController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [SeoController::class, 'update'])->name('update');
    });


    Route::prefix('cms/')->name('cms.')->group(function () {
        Route::prefix('our-service/')->name('ourservice.')->group(function () {
            Route::get('/', [OurServiceController::class, 'index'])->name('index');
            Route::get('/create', [OurServiceController::class, 'create'])->name('create');
            Route::post('/store', [OurServiceController::class, 'store'])->name('store');
            Route::get('/edit/{our_service}', [OurServiceController::class, 'edit'])->name('edit');
            Route::post('/update/{our_service}', [OurServiceController::class, 'update'])->name('update');
            Route::delete('/destroy/{our_service}', [OurServiceController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('ecommerce-service/')->name('ecommerceService.')->group(function () {
            Route::get('/', [EcommerceServiceController::class, 'index'])->name('index');
            Route::get('/create', [EcommerceServiceController::class, 'create'])->name('create');
            Route::post('/store', [EcommerceServiceController::class, 'store'])->name('store');
            Route::get('/edit/{ecommerce_service}', [EcommerceServiceController::class, 'edit'])->name('edit');
            Route::post('/update/{ecommerce_service}', [EcommerceServiceController::class, 'update'])->name('update');
            Route::delete('/destroy/{ecommerce_service}', [EcommerceServiceController::class, 'destroy'])->name('destroy');
        });

        Route::get('pages', [PageController::class, 'index'])->name('get.pages');
        Route::post('update-about-us', [PageController::class, 'update'])->name('update.pages');
    });
});
Route::post('upload-image', [SettingsController::class, 'uploadImage'])->name('upload-image');
