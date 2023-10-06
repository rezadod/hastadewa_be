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

Route::get('/cek', function () {
    return response()->json("GASS", 200);
});
Route::get('cek', [UserController::class, 'cek'])->name('cek');
Route::get('daftar', [UserController::class, 'daftar'])->name('daftar');
Route::get('masuk', [UserController::class, 'masuk'])->name('masuk');
Route::get('report_penjualan', [StockController::class, 'report_penjualan'])->name('report_penjualan');
Route::post('report_penjualan_detail', [StockController::class, 'report_penjualan_detail'])->name('report_penjualan_detail');
Route::post('report_penjualan_tampil', [StockController::class, 'report_penjualan_tampil'])->name('report_penjualan_tampil');

// Route::group(['middleware' => ['auth']], function () {
// });
Route::get('input_stok', [StockController::class, 'input_stok'])->name('input_stok');
Route::post('tambah_stok', [UserController::class, 'tambah_stok'])->name('tambah_stok');
Route::get('tampilan_stok', [UserController::class, 'tampilan_stok'])->name('tampilan_stok');

Route::group([
    'middleware' => 'api',
    // 'prefix' => 'auth'

], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('user', [AuthController::class, 'user']);

    Route::post('tambah_stock', [StockController::class, 'store']);
});

Route::get('/', function () {
    return view('welcome');
});
