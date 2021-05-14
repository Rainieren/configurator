<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get/configurable_products', [App\Http\Controllers\ProductController::class, 'getConfigurableProducts'])->name('getProducts');
Route::get('/get/products/interaction_type/{interaction_type}', [App\Http\Controllers\ProductController::class, 'getInteractionTypeProducts'])->name('getInteractionTypeProducts');

Route::get('/get/getRelatedSteps/{id}', [App\Http\Controllers\ProductController::class, 'getAllRelatedSteps'])->name('getRelatedSteps');
Route::get('/get/steps', [App\Http\Controllers\StepController::class, 'getSteps'])->name('getSteps');
Route::get('/get/interaction_types', [App\Http\Controllers\interactionTypeController::class, 'getInteractionTypes'])->name('getInteractionTypes');
Route::get('/get/manufacturers', [App\Http\Controllers\ManufacturerController::class, 'getAllManufacturers'])->name('getManufacturers');


Route::post('/store/configuration', [App\Http\Controllers\SummaryController::class, 'store'])->name('storeConfiguration');

Route::get('/get/all/summaries', [App\Http\Controllers\SummaryController::class, 'getAllSummaries'])->name('getAllSummaries');

