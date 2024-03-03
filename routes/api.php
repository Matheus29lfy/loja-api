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

/**Problema com rota sales quando tenho rotas do mesmo tipo ele se confunde e cai na primeira rota*/

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales', [SalesController::class, 'store']);
Route::get('/sales/get-finished', [SalesController::class, 'getAllFinished']);
Route::get('/sales/{saleId}', [SalesController::class, 'getSaleById']);
Route::post('/sales/{saleId}/add-product/{productId}', [SaleProductController::class, 'addProduct']);
Route::put('/sales/canceled/{saleId}', [SaleProductController::class, 'canceledSale']);
Route::put('/sales/finished/{saleId}', [SaleProductController::class, 'finishSale']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
