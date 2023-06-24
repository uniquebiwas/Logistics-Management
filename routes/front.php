<?php

use App\Http\Controllers\Front\ClientSearchController;
use App\Http\Controllers\Front\FrontEndController;
use App\Http\Controllers\Front\IndexPageController;
use App\Http\Controllers\Front\RegisterController;
use Illuminate\Support\Facades\Route;


Route::view('/rate', ['website.pages.rate']);
Route::view('/form-input', ['website.form']);
Route::view('/form-pdf', ['website.form-pdf']);
Route::view('/form-input1', ['website.form1']);
Route::view('/form-pdf1', ['website.form1-pdf']);
Route::view('/form-awb', ['website.awb']);
Route::view('/form-hbl', ['website.hbl']);
Route::view('/hbl-pdf', ['website.hbl-pdf']);
Route::view('/hbl-direct-pdf', ['website.hbl-direct-pdf']);
Route::view('/credit-invoice', ['website.credit-invoice']);

Route::get('/', [IndexPageController::class, 'index'])->name('index');
Route::post('/tracking', [FrontEndController::class, 'searchResult'])->name('result');
Route::get('/register', [FrontEndController::class, 'register'])->name('register');
Route::post('/registeruser', [FrontEndController::class, 'storeAgent'])->name('registeruser');
Route::get('/track-shipment', [ClientSearchController::class, 'search'])->name('clientPackageSearch');
Route::post('/contact-submit', [FrontEndController::class, 'contactSubmit'])->name('contact_form.store');
Route::get('/blog/{slug}', [IndexPageController::class, 'blogpage'])->name('blogDetails');
Route::get('/service/{slug}', [IndexPageController::class, 'servicePage'])->name('serviceDetails');
Route::get('/gallery/{slug}', [IndexPageController::class, 'galleryPage'])->name('galleryPage');
Route::post('/get-price', [ClientSearchController::class, 'searchPrice'])->name('searchPrice');
Route::get('/{getPage}', [FrontEndController::class, 'getPage'])->name('getPage');
// Route::get('/contactmail', [FrontEndController::class, 'contactmail'])->name('contactmail');

