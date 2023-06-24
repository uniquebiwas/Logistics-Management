<?php

use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BagController;
use App\Http\Controllers\Admin\BenifitController;
use App\Http\Controllers\Admin\CashInvoiceController;
use App\Http\Controllers\Admin\CreditController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DatabaseBackupController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PackageSearchController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SearchBagController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserLogController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Cargo\CargoInvoiceController;
use App\Http\Controllers\Cargo\GspController;
use App\Http\Controllers\Cargo\HblController;
use App\Http\Controllers\Cargo\NccController;
use App\Http\Controllers\Cargo\NeffaController;
use App\Http\Controllers\SearchAgentController;
use Illuminate\Support\Facades\Route;

Route::get('two-factor-recovery', [UserController::class, 'recovery'])->middleware('guest');
Route::post('nd-admin/logout', [UserController::class, 'logout'])->name('user.logout')->middleware(['auth']);

Route::group(['prefix' => '/nd-admin', 'middleware' => ['auth', 'IsPasswordReset']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('agent-credit', CreditController::class);
    Route::get('credit-history/{id}/{type}',  [CreditController::class, 'edit'])->name('credit-history.edit');
    Route::resource('bag', BagController::class);
    Route::resource('benefit', BenifitController::class);
    Route::prefix('location')->group(function () {
        Route::get('/{location}/edit/{type?}', [LocationController::class, 'edit'])->name('location.edit');
        Route::get('create/{type?}', [LocationController::class, 'create'])->name('location.create');
        Route::patch('{location}/{type?}', [LocationController::class, 'update'])->name('location.update');
        Route::get('{type?}', [LocationController::class, 'index'])->name('location.index');
        Route::post('{type?}', [LocationController::class, 'store'])->name('location.store');
        Route::delete('{location}/{type?}', [LocationController::class, 'destroy'])->name('location.destroy');
    });


    Route::get('/credit-history/{agentId}', [CreditController::class, 'history'])->name('credit-history');
    Route::get('create-advance', [CreditController::class, 'createAdvance'])->name('createAdvance');
    Route::get('setting/sms', [AppSettingController::class, 'smsApi'])->name('smsApi.index')->middleware('password.confirm');
    Route::post('setting/sms', [AppSettingController::class, 'smsApiSave'])->name('smsApi.store');
    Route::put('setting/sms/{id}/update', [AppSettingController::class, 'smsApiUpdate'])->name('smsApi.update');
    Route::resource('setting', AppSettingController::class)->middleware('password.confirm');

    Route::resource('slider', SliderController::class);

    Route::resource('feature', FeatureController::class);
    Route::post('feature/orderupdate', [FeatureController::class, 'updateOrder'])->name('updateOrderFeature');

    Route::resource('information', InformationController::class);

    Route::get('clear-log', [UserLogController::class, 'ClearAll'])->name('clear-log');
    Route::get('user-log', UserLogController::class)->name('user-log.index');
    Route::post('update', [MenuController::class, 'updateMenuOrder'])->name('update.menu');

    Route::get('additional-menu/{id}', [MenuController::class, 'additional_menu'])->name('menu.additonal');
    Route::resource('menu', MenuController::class)->middleware('password.confirm');
    Route::resource('team', TeamController::class);

    Route::resource('designations', DesignationController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('gallery', GalleryController::class);
    Route::get('/removeGalleryImage/{id}', [GalleryController::class, 'removeGalleryImage'])->name('removegalleryimage');

    Route::post('updateDesignation', [DesignationController::class, 'updateDesignationOrder'])->name('update.designation');
    Route::get('designation/original/order', [DesignationController::class, 'resetorder'])->name('designation.resetorder');

    Route::resource('medialibrary', MediaLibraryController::class);
    Route::post('shipment-package-search', [PackageSearchController::class, 'index'])->name('search-shipment-package');
    Route::post('shipment-package-invoice', [PackageSearchController::class, 'searchShipment'])->name('search-invoice');

    Route::post('bag-search', [SearchBagController::class, 'index'])->name('search-bag');

    Route::get('/cash-invoice', [CashInvoiceController::class, 'index'])->name('cashinvoice.index');
    Route::post('/get-agent-user', [SearchAgentController::class, 'getAgent'])->name('getSingleAgent');
    Route::get('/database-backup', [DatabaseBackupController::class, 'index'])->name('database.backup.show');
    Route::post('database-backup', [DatabaseBackupController::class, 'runDatabaseBackup'])->name('database.backup');

    Route::resource('gsp', GspController::class);
    Route::resource('ncc', NccController::class);
    Route::resource('hbl', HblController::class);
    Route::resource('neffa', NeffaController::class);
    Route::post('cargo-invoice/update/{id}', [CargoInvoiceController::class, 'changePaymentStatus'])->name('change-cargo-payment-status');
    Route::resource('cargo-invoice', CargoInvoiceController::class);
});
