<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\StockController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group([
    'middleware' => ['api', 'jwt.auth'],
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    // ! USER
    Route::post('user', [AuthController::class, 'user']);
    // ! STOCK
    Route::post('tambah_stock', [StockController::class, 'store']);
    Route::post('update_stock', [StockController::class, 'update']);

    Route::get('data_satuan', [StockController::class, 'data_satuan']);

    Route::get('stock', [StockController::class, 'index']);
    Route::post('detail_stock', [StockController::class, 'detailKasir']);
    // ! KERANJANG
    Route::post('keranjang', [KeranjangController::class, 'store']);
    Route::get('invoice', [KeranjangController::class, 'invoice']);
});
