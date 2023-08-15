<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;

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

Route::get('cek', [UserController::class, 'cek'])->name('cek');
Route::get('daftar', [UserController::class, 'daftar'])->name('daftar');
Route::get('masuk', [UserController::class, 'masuk'])->name('masuk');

Route::group(['middleware' => ['auth']], function () {
    Route::get('input_stok', [StockController::class, 'input_stok'])->name('input_stok');
});

Route::group([
    'middleware' => 'api',
    // 'prefix' => 'auth'

], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('user', [AuthController::class, 'user']);

    Route::post('add_stock', [StockController::class, 'store']);
});

Route::get('/', function () {
    return view('welcome');
});
