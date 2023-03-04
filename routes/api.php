<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductController;
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

// 商品情報
Route::get('/allProduct', [ProductController::class, 'getAllProducts']);
Route::get('/product', [ProductController::class, 'getProductById']);
Route::post('/product', [ProductController::class, 'createProduct']);
Route::post('/updateProduct', [ProductController::class, 'updateProduct']);
Route::post('/deleteProduct', [ProductController::class, 'deleteProduct']);
// 顧客情報
Route::get('/allCustomer', [CustomerController::class, 'getAllCustomers']);
Route::get('/customer', [CustomerController::class, 'getCustomer']);
Route::post('createCustomer', [CustomerController::class, 'createCustomer']);
Route::post('/updateCustomer', [CustomerController::class, 'updateCustomer']);
// 出荷
Route::get('/allDelivery', [DeliveryController::class, 'getAllDeliveries']);
Route::get('/delivery', [DeliveryController::class, 'getDeliveryById']);
