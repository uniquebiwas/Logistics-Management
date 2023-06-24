<?php

use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\ChangeEmailController;
use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipPackageController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ServiceableCountryController;
use App\Http\Controllers\Admin\ServiceAgentController;
use App\Http\Controllers\Admin\ShipmentPackageController;
use App\Http\Controllers\Admin\ShipmentZoneImportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserDetailController;
use App\Http\Controllers\Admin\ZonalController;
use App\Http\Controllers\Admin\ZonalImportController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentDocumentController;
use App\Http\Controllers\Agent\AgentItemController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Agent\MembershipPackageController as AgentMembershipPackageController;
use App\Http\Controllers\Agent\SendMobileOtpController;
use App\Http\Controllers\Agent\TrackController;
use App\Http\Controllers\Agent\AgentCreditController;
use App\Http\Controllers\Agent\AgentInvoiceController;
use App\Http\Controllers\Agent\StaffController;
use App\Http\Controllers\Agent\ZonePriceController;
use Illuminate\Support\Facades\Route;


Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');
Route::get('two-factor-recovery', [UserController::class, 'recovery'])->middleware('guest');

Route::group(['prefix' => '/nd-admin', 'middleware' => ['auth']], function () {
    Route::post('getCountries', [ShipmentPackageController::class, 'getCountries'])->name('shipmentpackage.countries');
    Route::post('getCustomer', [ShipmentPackageController::class, 'getCustomerData'])->name('shipmentpackage.customer');
    Route::put('{id}/changepassword', [UserController::class, 'updatePassword'])->name('update-password');
    Route::get('profiledetail', [UserController::class, 'profiledetail'])->name('profiledetail')->middleware('password.confirm');
    Route::post('/changeEmail/{userId}', [ChangeEmailController::class, 'changeEmail'])->name('changeEmail');
});

Route::group(['prefix' => '/nd-admin', 'middleware' => ['auth', 'verified', 'IsPasswordReset']], function () {
    Route::post('get-user-information', [UserDetailController::class, 'index'])->name('getuserInformation');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    include __DIR__ . "/web/cms_route.php";
    include __DIR__ . "/web/user_route.php";
    include __DIR__ . "/web/shipment_routes.php";
    Route::get('serviceable-country', [ServiceableCountryController::class, 'index'])->name('serviceable-country.index');
    Route::get('/edit-country', [ServiceableCountryController::class, 'editCountries'])->name('editCountries');
    Route::post('update-countries', [ServiceableCountryController::class, 'updateCountries'])->name('updateCountries');
    Route::resource('customers', CustomerController::class);
    Route::resource('agents', AgentController::class);
    Route::post('verifyDocument/{id}', [AgentController::class, 'verifyDocument'])->name('agents.verifyDocument');
    Route::post('verifyEmail/{id}', [AgentController::class, 'verifyEmail'])->name('agents.verifyEmail');
    Route::post('verifyPhone/{id}', [AgentController::class, 'verifyPhone'])->name('agents.verifyPhone');
    Route::post('/numberexists', [UserController::class, 'numberexists'])->name('numberexists');



    Route::resource('membership', MembershipPackageController::class);
    Route::get('membershipHistory', [MembershipPackageController::class, 'membershipHistory'])->name('admin.membership.history');


    Route::resource('zonal', ZonalController::class);
    Route::get('zonal-import', [ZonalImportController::class, 'zonalImport'])->name('zonal-import');
    Route::post('zonal-import', [ZonalImportController::class, 'zonalImportStore'])->name('zonal-import-store');
    Route::get('zonal-import-excel', [ZonalImportController::class, 'export'])->name('zonal-import-export');


    Route::get('zonaledit/{serviceid}/{zoneid}', [ZonalController::class, 'zonalEdit'])->name('zonal.bulkedit');
    Route::post('zonaledit', [ZonalController::class, 'zonalUpdate'])->name('zonal.bulkupdate');

    Route::post('getCountries', [ZonalController::class, 'getCountries'])->name('zonal.getCountries');

    Route::resource('serviceagent', ServiceAgentController::class);

    Route::get('agent-pricing', [PricingController::class, 'agentindex'])->name('admin.pricing.agent');
    Route::get('agent-pricing/create', [PricingController::class, 'agentPricingCreate'])->name('admin.pricing.agent.create');
    Route::get('agent-pricing/edit/{id}', [PricingController::class, 'agentPricingEdit'])->name('admin.pricing.agent.edit');
    Route::resource('pricing', PricingController::class);
    Route::post('/agent-pricing-store', [ShipmentZoneImportController::class, 'store'])->name('pricing.excel');


    Route::post('getCountriesAndZone', [PricingController::class, 'getCountriesAndZone'])->name('pricing.getCountriesAndZone');
    Route::resource('agentdocument', AgentDocumentController::class);
    Route::post('/verifydocument/{id}', [AgentController::class, 'verifyIndiDocument'])->name('agent.document.verify');
    Route::post('requestdocument', [AgentController::class, 'requestDocument'])->name('agentdocument.request');
});

Route::group(['prefix' => 'agent', 'middleware' => ['auth', 'IsPasswordReset']], function ($router) {
    $router->get('/agent', [AgentDashboardController::class, 'agent'])->name('agent');
    $router->get('/track-and-trace', [TrackController::class, 'searchPage'])->name('trackshipment.page');
    $router->post('/send-otp', [SendMobileOtpController::class, 'sendMobileVerifyOtp'])->name('sendMobileVerifyOtp');
    $router->get('/my-profile', [AgentProfileController::class, 'agentProfile'])->name('agentProfile');
    $router->get('/edit-profile', [AgentProfileController::class, 'agentEditProfile'])->name('agentEditProfile');
    $router->post('update-profile', [AgentProfileController::class, 'updateAgentProfile'])->name('updateAgentProfile');
    $router->get('/documents', [AgentDocumentController::class, 'agentDocuments'])->name('agentDocuments');
    $router->get('/submit-documents', [AgentDocumentController::class, 'sendDocuments']);
    $router->post('submit-documents', [AgentDocumentController::class, 'submitDocuments'])->name('sendDocuments');
    $router->resource('customer', CustomerController::class);
    $router->post('sendVerificationEmail/{id}', [AgentDashboardController::class, 'sendVerificationEmail'])->name('agent.sendVerificationEmail');
    $router->get('verifyUser/{token}', [AgentDashboardController::class, 'verifyUser'])->name('agent.verifyUser');
    Route::resource('agent-staff', StaffController::class)->middleware('isVerifiedAgent');
    Route::get('agent-pricing', [ZonePriceController::class, 'agentindex'])->name('agent-pricings')->middleware('isVerifiedAgent');
    Route::get('country-guide', [ZonePriceController::class, 'zone'])->name('agentCountry')->middleware('isVerifiedAgent');
    $router->post('buyMembership/{id}', [AgentMembershipPackageController::class, 'buyMembership'])->name('agent.buyMembership');
    $router->get('membershipHistory', [AgentMembershipPackageController::class, 'membershipHistory'])->name('agentmembership.history');
    $router->resource('agentmembership', AgentMembershipPackageController::class);
    $router->resource('credit', AgentCreditController::class)->only(['index', 'show'])->middleware('isVerifiedAgent');
    Route::post('update-duedate-credit', [AgentCreditController::class, 'changeDueDate'])->name('credit-dueDate-change');
    $router->get('credit-history', [AgentCreditController::class, 'history'])->name('agent-history')->middleware('isVerifiedAgent');
    $router->get('invoice', [AgentInvoiceController::class, 'index'])->name('agent-invoice')->middleware('isVerifiedAgent');
    $router->get('invoice-documents/{id}', [AgentInvoiceController::class, 'documentShow'])->name('invoice.documents')->middleware('isVerifiedAgent');
    $router->post('invoice-documents', [AgentInvoiceController::class, 'submitDocuments'])->name('invoice.documents.submit')->middleware('isVerifiedAgent');

    $router->group(['prefix' =>  'shipments', 'middleware' => 'isVerifiedAgent'], function ($router) {

        $router->get('/', [ShipmentPackageController::class, 'index'])->name('shipment.index');
        $router->get('/shipment-detail/{id}', [ShipmentPackageController::class, 'show'])->name('shipment.show');
        $router->post('/cancel-shipment/{id}', [AgentItemController::class, 'cancel'])->name('shipment.cancel');
        $router->get('/add-shipment', [ShipmentPackageController::class, 'create'])->name('shipment.create');
        $router->post('/store-shipment', [ShipmentPackageController::class, 'store'])->name('shipment.store');
        $router->get('/edit-shipment/{id}', [ShipmentPackageController::class, 'edit'])->name('shipment.edit');
        $router->put('/update-shipment/{id}', [ShipmentPackageController::class, 'update'])->name('shipment.update');
        $router->delete('/delete-shipment/{id}', [ShipmentPackageController::class, 'destroy'])->name('shipment.destroy');
    });
});
