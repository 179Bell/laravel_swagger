<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
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

Route::prefix('v1')->group((function () {
    Route::get('/products', [ProductController::class, 'getAllProducts']);
    Route::get('/products/{id}', [ProductController::class, 'getProductById']);
    Route::post('/products', [ProductController::class, 'createProduct']);
    Route::put('/products/update', [ProductController::class, 'updateProduct']);
    Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);
    // 顧客情報
    Route::get('/customers', [CustomerController::class, 'getAllCustomers']);
    Route::get('/customers/{id}', [CustomerController::class, 'getCustomer']);
    Route::post('customers', [CustomerController::class, 'createCustomer']);
    Route::put('/customers', [CustomerController::class, 'updateCustomer']);
    Route::delete('/customer/{id}', [CustomerController::class, 'deleteCustomer']);
    // 注文
    Route::get('/orders', [OrderController::class, 'getAllOrders']);
    Route::get('/orders/{id}', [OrderController::class, 'getOrderById']);
    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::put('/orders', [OrderController::class, 'updateOrder']);
    Route::delete('/orders/{id}', [OrderController::class, 'deleteOrder']);
}));
// 商品情報
