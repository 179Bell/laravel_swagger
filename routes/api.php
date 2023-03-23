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
    Route::get('/allCustomer', [CustomerController::class, 'getAllCustomers']);
    Route::get('/customer', [CustomerController::class, 'getCustomer']);
    Route::post('createCustomer', [CustomerController::class, 'createCustomer']);
    Route::post('/updateCustomer', [CustomerController::class, 'updateCustomer']);
    Route::post('/deleteCustomer', [CustomerController::class, 'deleteCustomer']);
    // 注文
    Route::get('/allOrder', [OrderController::class, 'getAllOrders']);
    Route::get('/order', [OrderController::class, 'getOrderById']);
    Route::post('/createOrder', [OrderController::class, 'createOrder']);
    Route::post('/updateOrder', [OrderController::class, 'updateOrder']);
    Route::post('/deleteOrder', [OrderController::class, 'deleteOrder']);
}));
// 商品情報
