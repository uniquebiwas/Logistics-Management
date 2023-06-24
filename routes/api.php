<?php

use App\Http\Controllers\Api\Auth\SanctumController;
use App\Http\Controllers\Api\ImportOrderController;
use App\Http\Controllers\Api\IntegratorController;
use App\Http\Controllers\Api\PrintLabelController;
use App\Http\Controllers\Api\SearchPriceController;
use App\Http\Controllers\Api\TrackingOrderController;
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
//,'middleware' => 'throttle:60,1'

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [SanctumController::class, 'login']);
Route::post('/logout', [SanctumController::class, 'logout'])->middleware(['auth:sanctum']);

//External API
/*
|--------------------------------------------------------------------------
| Proceed With Extreme Cautions Only.
|--------------------------------------------------------------------------
*/
Route::get('/integrator', [IntegratorController::class, 'integrator']);
Route::post('/price', [IntegratorController::class, 'pricing']);

/*
|--------------------------------------------------------------------------
| Australian Client  Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/import-orders/count/{count?}', [ImportOrderController::class, 'import']);
    Route::delete('/remove', [ImportOrderController::class, 'removeOrder']);
    Route::get('/print-label/{id}', [PrintLabelController::class, 'printLabel']);
    Route::get('/forward-tracking', [TrackingOrderController::class, 'byPassing']);
});

/*
|--------------------------------------------------------------------------
| Search Shipment Package Price
|--------------------------------------------------------------------------
*/

Route::post('search-shipment-totalprice', [SearchPriceController::class, 'searchPrice'])->name('search-shipment-totalprice');
/*
|--------------------------------------------------------------------------
| Fallback   Routes
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->json(['message' => ['Server was not able to retrieve the requested page.']], 404);
});
