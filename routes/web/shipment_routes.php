<?php

use App\Http\Controllers\Admin\CashShipmentController;
use App\Http\Controllers\Admin\PerformaController;
use App\Http\Controllers\Admin\ShipmentCancellationReasonController;
use App\Http\Controllers\Admin\ShipmentLocationController;
use App\Http\Controllers\Admin\ShipmentPackageController;
use App\Http\Controllers\Admin\ShipmentPackageTypeController;
use App\Http\Controllers\Admin\ShipmentZoneController;
use App\Http\Controllers\Agent\AgentItemController;
use App\Http\Controllers\Admin\ShipmentPackageReportController;
use App\Http\Controllers\Admin\InternationalManifestController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoiceOverpriceController;
use App\Http\Controllers\Admin\LoadController;
use App\Http\Controllers\Admin\ManifestExcelExportController;
use App\Http\Controllers\Admin\NationalManifestController;
use App\Http\Controllers\Admin\NationalManifestPackageController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ShipmentZoneImportController;
use App\Http\Controllers\Admin\ShimentPackageCSVController;
use App\Http\Controllers\Admin\ShipmentReceiptController;
use App\Http\Controllers\InvoiceCancelController;
use Illuminate\Support\Facades\Route;

Route::resource('shipmentcancellationreason', ShipmentCancellationReasonController::class);
Route::resource('shipmentpackage', ShipmentPackageController::class);
Route::get('cash-form', [CashShipmentController::class, 'index'])->name('shipment-cash-form');
Route::resource('shipmentzone', ShipmentZoneController::class);
Route::get('shipment-zone-import', [ShipmentZoneImportController::class, 'index'])->name('import-shipment-zone');
Route::post('shipment-zone-import', [ShipmentZoneImportController::class, 'store'])->name('import-shipment-zone-store');
Route::get('shipment-zone-example', [ShipmentZoneImportController::class, 'export'])->name('import-shipment-zone-download');

Route::resource('shipmentpackagetype', ShipmentPackageTypeController::class);
Route::get('/performa/{id}', [PerformaController::class, 'performa'])->name('performa');
Route::get('/shipementDetail/{id}', [ShipmentPackageController::class, 'detailForm'])->name('detail.form');

// << -----------------------------------------  Pending Shipment   --------------------------------------------------->>

Route::get('/pendingShipmentPackage', [ShipmentPackageController::class, 'pendingIndex'])->name('shipmentpackage.pending');
Route::post('/approvePackage/{id}', [ShipmentPackageController::class, 'approvePackage'])->name('shipmentpackage.approve');
Route::post('/declinePackage/{id}', [ShipmentPackageController::class, 'declinePackage'])->name('shipmentpackage.decline');
// << -----------------------------------------  Shipment Location   --------------------------------------------------->>

Route::get('/package-location/{shipmentId}', [ShipmentLocationController::class, 'index'])->name('shipmentpackage-location');
Route::post('/package-location/{shipmentId}', [ShipmentLocationController::class, 'store'])->name('shipmentpackage-location-store');

// << -----------------------------------------  Approved Shipment   --------------------------------------------------->>
Route::get('/approvedShipmentPackage', [ShipmentPackageController::class, 'approvedIndex'])->name('shipmentpackage.approved');
Route::post('/packageReceived/{id}', [ShipmentPackageController::class, 'packageReceived'])->name('shipmentpackage.receive');

// << -----------------------------------------  Cancelled Shipment   --------------------------------------------------->>
Route::get('/adminCancelledPackage', [ShipmentPackageController::class, 'adminCancelledIndex'])->name('shipmentpackage.cancelled.admin');
Route::get('/agentCancelledPackage', [ShipmentPackageController::class, 'agentCancelledIndex'])->name('shipmentpackage.cancelled.agent');

// << -----------------------------------------  Received Shipment   --------------------------------------------------->>
Route::get('/receivedShipmentPackage', [ShipmentPackageController::class, 'receivedIndex'])->name('shipmentpackage.received');

// << -----------------------------------------  Manifested Shipment   --------------------------------------------------->>
Route::get('/manifestedShipmentPackage', [ShipmentPackageController::class, 'manifestedIndex'])->name('shipmentpackage.manifested');
Route::get('/downloadDocument/{id}', [ShipmentPackageController::class, 'downloadDocument'])->name('downloadDocument');


// << -----------------------------------------  Scheduled Shipment   --------------------------------------------------->>
Route::get('/scheduledShipmentPackage', [ShipmentPackageController::class, 'scheduledIndex'])->name('shipmentpackage.scheduled');
Route::post('/schedulePackage/{id}', [ShipmentPackageController::class, 'schedulePackage'])->name('shipmentpackage.schedule');
Route::post('/schedule-bulk-shipemnt', [ScheduleController::class, 'bulkShipmentSchedule'])->name('shipmentpackage.bulkSchedule');

Route::post('/trackingcode/{id}', [ShipmentPackageController::class, 'trackingcode'])->name('shipmentpackage.trackingcode');

// << -----------------------------------------  Dispatched Shipment   --------------------------------------------------->>
Route::get('/dispatchedShipmentPackage', [ShipmentPackageController::class, 'dispatchedIndex'])->name('shipmentpackage.dispatched');

// << -----------------------------------------  In Cargo Shipment   --------------------------------------------------->>
Route::get('/incargoShipmentPackage', [ShipmentPackageController::class, 'incargoIndex'])->name('shipmentpackage.incargo');
Route::post('/delieveredReceived/{id}', [ShipmentPackageController::class, 'deliveredPackage'])->name('shipmentpackage.deliever');

// << -----------------------------------------  Delivered Shipment   --------------------------------------------------->>
Route::get('/deliveredShipmentPackage', [ShipmentPackageController::class, 'deliveredIndex'])->name('shipmentpackage.delivered');

// << -----------------------------------------  Hand over to agent   --------------------------------------------------->>
Route::get('/handovertoagent', [ShipmentPackageController::class, 'handovertoagentIndex'])->name('shipmentpackage.handovertoagent');


// << -----------------------------------------  AWB Routes   --------------------------------------------------->>
Route::get('/pdf/{id}', [ShipmentPackageController::class, 'pdfView']);
Route::get('/generateAWBill/{id}', [ShipmentPackageController::class, 'generateAWB'])->name('shipmentpackage.generate.awb');
Route::get('/generateAWBillMaster/{id}', [ShipmentPackageController::class, 'generateAWBMaster'])->name('shipmentpackage.generate.awbmaster');
Route::post('/updateAWBNumber', [ShipmentPackageController::class, 'dispatchPackage'])->name('shipmentpackage.dispatch');
Route::post('/generateAWBill', [ShipmentPackageController::class, 'generateBulkAWB'])->name('shipmentpackage.generate.awb.bulk');

Route::get('/generateLabel/{id}', [ShipmentPackageController::class, 'generateLabel'])->name('shipmentpackage.generate.label');

// << -----------------------------------------  Track Shipment   --------------------------------------------------->>
Route::post('track-dhl-shipment', [ShipmentPackageController::class, 'trackDHLShipment'])->name('shipmentpackage.trackdhl');
Route::post('track-fedex-shipment', [ShipmentPackageController::class, 'trackFedExShipment'])->name('shipmentpackage.trackfedex');

// << -----------------------------------------  Track Shipment   --------------------------------------------------->>
Route::resource('international-manifest', InternationalManifestController::class)->except('delete');
Route::resource('national-manifest', NationalManifestController::class);
Route::get('/download-manifest-excel/{id}', [ManifestExcelExportController::class, 'exportExcel'])->name('export-manifest-excel');
Route::get('national-manifest-bag/{id}', [NationalManifestController::class, 'showbag'])->name('nationalmanifestBag');
Route::post('national-manifest-bag/{id}', [NationalManifestController::class, 'deleteBag'])->name('nationalmanifestBagDelete');
Route::get('/national-manifest-excel/{id}/export', [ManifestExcelExportController::class, 'nationalManifestExport'])->name('nationalManifestExport');


Route::resource('invoice', InvoiceController::class)->except('delete');
Route::post('/invoice-payment-status/{id}', [InvoiceController::class, 'changePaymentStatus'])->name('change-invoice-payment');
Route::get('awb-invoiced/{sort?}', [InvoiceController::class, 'invoicedShipment'])->name('invoiced-shipment');
Route::get('shipment-invoice/{id}', [InvoiceOverpriceController::class, 'edit'])->name('overpriced-invoice');
Route::post('shipment-invoice/{id}', [InvoiceOverpriceController::class, 'createInvoice'])->name('overpriced-invoice-save');
Route::resource('export', ShimentPackageCSVController::class);
Route::post('exportcsv', [ShimentPackageCSVController::class, 'exportShipmentPackage'])->name('exportShipmentPackage');
Route::post('redownload/{id}', [ShimentPackageCSVController::class, 'downloadUploading'])->name('redownloadCSV');
Route::get('/receipt/{id}', [ShipmentReceiptController::class, 'getReceipt'])->name('getReceipt');
Route::post('/invoice-cancel/{id}/{type?}', [InvoiceCancelController::class, 'cancelInvoice'])->name('cancel-invoice');

Route::post('load-shipment', [LoadController::class, 'store'])->name('load.store');
Route::delete('load-shipment/{load}', [LoadController::class, 'deleteLoad'])->name('load.destroy');
