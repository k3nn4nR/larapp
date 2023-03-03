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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('api_login');
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('api_logout');

Route::middleware('auth:sanctum')->get('/test', [App\Http\Controllers\CodeController::class, 'test'])->name('test');

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(App\Http\Controllers\ItemController::class)->group(function () {
        Route::get('/items', 'index')->name('item.index');
        Route::post('/items', 'store')->name('item.store');
        Route::get('/dashboard', 'dashboard')->name('item_dashboard');
    });

    Route::controller(App\Http\Controllers\BrandController::class)->group(function () {
        Route::post('/brands', 'store')->name('brand.store');
        Route::get('/brands', 'index')->name('brand.index');
    });

    Route::controller(App\Http\Controllers\CompanyController::class)->group(function () {
        Route::post('/companies', 'store')->name('company.store');
    });

    Route::controller(App\Http\Controllers\CurrencyController::class)->group(function () {
        Route::post('/currencies', 'store')->name('currency.store');
    });

    Route::controller(App\Http\Controllers\ItemFamilyController::class)->group(function () {
        Route::get('/item_families', 'index')->name('item_family.index');
    });

    Route::controller(App\Http\Controllers\PaymentController::class)->group(function () {
        Route::post('/payments', 'store')->name('payment.store');
    });

    Route::controller(App\Http\Controllers\PaymentTypeController::class)->group(function () {
        Route::post('/payment_types', 'store')->name('payment_type.store');
    });

    Route::controller(App\Http\Controllers\ServiceController::class)->group(function () {
        Route::post('/services', 'store')->name('service.store');
    });

    Route::controller(App\Http\Controllers\TypeController::class)->group(function () {
        Route::post('/types', 'store')->name('type.store');
    });
});
