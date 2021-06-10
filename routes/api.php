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

Route::get('/get/configurable_products/{id}', [App\Http\Controllers\ProductController::class, 'getConfigurableProductsFromId']);
Route::get('/get/configurable_products', [App\Http\Controllers\ProductController::class, 'getConfigurableProducts']);

Route::get('/get/configurable_products_with_no_configurator', [App\Http\Controllers\ProductController::class, 'getAllProductsWithNoConfigurator']);

Route::get('/get/products/interaction_type/{interaction_type}', [App\Http\Controllers\ProductController::class, 'getInteractionTypeProducts'])->name('getInteractionTypeProducts');
Route::patch('/update/product/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');

Route::get('/get/getRelatedSteps/{id}', [App\Http\Controllers\ProductController::class, 'getAllRelatedSteps'])->name('getRelatedSteps');
Route::get('/get/steps', [App\Http\Controllers\StepController::class, 'getSteps'])->name('getSteps');
Route::patch('/update/step/{id}', [App\Http\Controllers\StepController::class, 'update'])->name('updateStep');


Route::delete('/delete/step/{id}/option', [App\Http\Controllers\StepController::class, 'deleteStepOption'])->name('deleteStepOption');

Route::get('/get/parentProducts/{step_id}', [App\Http\Controllers\ProductController::class, 'getParentProducts'])->name('getParentProducts');

Route::get('/get/interaction_types', [App\Http\Controllers\interactionTypeController::class, 'getInteractionTypes'])->name('getInteractionTypes');
Route::get('/get/manufacturers', [App\Http\Controllers\ManufacturerController::class, 'getAllManufacturers'])->name('getManufacturers');


Route::post('/store/configuration', [App\Http\Controllers\SummaryController::class, 'store'])->name('storeConfiguration');
Route::put('/change/steps/order', [App\Http\Controllers\StepController::class, 'changeOrder'])->name('changeStepOrder');

Route::get('/get/all/summaries', [App\Http\Controllers\SummaryController::class, 'getAllSummaries'])->name('getAllSummaries');

Route::get('/get/all/countries', [App\Http\Controllers\CountryController::class, 'getAllCountries'])->name('getAllCountries');




Route::get('/get/all/configurators', [App\Http\Controllers\ConfiguratorController::class, 'getAllConfiguratorsWithProducts']);
Route::get('/get/configurators', [App\Http\Controllers\ConfiguratorController::class, 'getAllConfigurators']);
Route::get('/get/configuration/{id}', [App\Http\Controllers\ConfiguratorController::class, 'getConfigurator']);
Route::patch('/configurator/{id}/update', [App\Http\Controllers\ConfiguratorController::class, 'update'])->name('updateConfigurator');

