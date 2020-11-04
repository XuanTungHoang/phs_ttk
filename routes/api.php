<?php

use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Tai khoan
Route::get('/taikhoan',[UserController::class,'index']);
Route::post('/taikhoan',[UserController::class,'store']);
Route::get('/taikhoan/{id}',[UserController::class,'show']);
Route::put('/taikhoan/{id}',[UserController::class,'update']);
Route::delete('/taikhoan/{id}',[UserController::class,'destroy']);

// Khach hang
Route::get('/khachhang',[KhachHangController::class,'index']);
Route::post('/khachhang',[KhachHangController::class,'store']);
Route::get('/khachhang/{id}',[KhachHangController::class,'show']);
Route::put('/khachhang/{id}',[KhachHangController::class,'update']);
Route::delete('/khachhang/{id}',[KhachHangController::class,'destroy']);

