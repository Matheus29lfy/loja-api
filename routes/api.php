<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleProductController;
use App\Http\Controllers\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales', [SalesController::class, 'store']);
Route::get('/sales/{saleId}', [SalesController::class, 'getSaleById']);
Route::post('/sales/{saleId}/add-product/{productId}', [SaleProductController::class, 'addProduct']);
Route::delete('/sales/delete/{saleId}', [SaleProductController::class, 'deleteSale']);
Route::post('/sales/finished/{saleId}', [SaleProductController::class, 'finishSale']);
Route::get('/sales/finished', [SalesController::class, 'getAllFinished']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
