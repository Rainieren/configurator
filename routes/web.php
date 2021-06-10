<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/manufacturers', [App\Http\Controllers\ManufacturerController::class, 'index'])->name('manufacturers');
    Route::get('/steps', [App\Http\Controllers\StepController::class, 'index'])->name('steps');
    Route::get('/configurators', [App\Http\Controllers\ConfiguratorController::class, 'index'])->name('configurators');



    // All routes related to products
    Route::prefix('product')->group(function () {

        Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('createProduct');
        Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');



        Route::get('/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('showProduct');

        Route::get('/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
        Route::patch('{id}/update', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');

        Route::delete('/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct');
    });

    // All routes related to manufacturers
    Route::prefix('manufacturer')->group(function () {
        Route::get('/create', [App\Http\Controllers\ManufacturerController::class, 'create'])->name('createManufacturer');
        Route::post('/store', [App\Http\Controllers\ManufacturerController::class, 'store'])->name('storeManufacturer');
        Route::get('/{id}', [App\Http\Controllers\ManufacturerController::class, 'show'])->name('manufacturer');
        Route::get('/{id}/edit', [App\Http\Controllers\ManufacturerController::class, 'edit'])->name('editManufacturer');
        Route::delete('/{id}/delete', [App\Http\Controllers\ManufacturerController::class, 'destroy'])->name('deleteManufacturer');
    });

    // All routes related to steps
    Route::prefix('step')->group(function () {
        Route::get('/create', [App\Http\Controllers\StepController::class, 'create'])->name('createStep');
        Route::get('/{id}', [App\Http\Controllers\StepController::class, 'show'])->name('step');
        Route::post('/store', [App\Http\Controllers\StepController::class, 'store'])->name('storeStep');
        Route::get('/{id}/edit', [App\Http\Controllers\StepController::class, 'edit'])->name('editStep');
        Route::delete('/{id}/delete', [App\Http\Controllers\StepController::class, 'destroy'])->name('deleteStep');
    });

    Route::prefix('configurator')->group(function () {

        Route::get('/create', [App\Http\Controllers\ConfiguratorController::class, 'create'])->name('createConfigurator');
        Route::post('/store', [App\Http\Controllers\ConfiguratorController::class, 'store'])->name('storeConfigurator');

        Route::get('/{id}', [App\Http\Controllers\ConfiguratorController::class, 'show'])->name('configurator');
        Route::get('/{id}/edit', [App\Http\Controllers\ConfiguratorController::class, 'edit'])->name('editConfigurator');

        Route::delete('/{id}/delete', [App\Http\Controllers\ConfiguratorController::class, 'destroy'])->name('deleteConfigurator');
    });
});

Route::prefix('configurator')->group(function () {
    Route::get('/', [App\Http\Controllers\ConfiguratorController::class, 'index'])->name('configurator');
});
