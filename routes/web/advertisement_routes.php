<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdvertisementController;

Route::resource('advertisement', AdvertisementController::class);
Route::get('/getAdpositions', [AdvertisementPositionController::class, 'getAdpositions'])->name('getAdpositions');
Route::get('advertisements/sorting', [AdvertisementController::class, 'advertisementssorting'])->name('advertisements.sort');
Route::get('advertisement/ording/{id}', [AdvertisementController::class, 'advertisementording'])->name('advertisement.ordering');
Route::post('advertisement/update/ording', [AdvertisementController::class, 'updateadvertisementOrder'])->name('advertisement.updae.order');
Route::get('advertisement/original/ording', [AdvertisementController::class, 'originaladvertisementOrder'])->name('advertisements.original.order');
