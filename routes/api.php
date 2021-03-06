<?php

use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\NhapXuatSach;
use App\Http\Controllers\AuthController;
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

// Sach  
Route::get('/sach',[SachController::class,'index']);
Route::post('/sach',[SachController::class,'store']);
Route::get('/sach/{id}',[SachController::class,'show']);
Route::put('/sach/{id}',[SachController::class,'update']);
Route::delete('/sach/{id}',[SachController::class,'destroy']);

// Quan li nhap xuat
Route::post('/phieunhap',[NhapXuatSach::class,'TaoPhieuNhap']);
Route::post('/phieuxuat',[NhapXuatSach::class,'TaoPhieuXuat']);

// Quan li hoa don 
Route::get('/hoadonnhap',[NhapXuatSach::class,'DSHoaDonNhap']);
Route::get('/hoadonnhap/{id}',[NhapXuatSach::class,'CTHoaDonNhap']);
Route::get('/hoadonxuat',[NhapXuatSach::class,'DSHoaDonXuat']);
Route::get('/hoadonxuat/{id}',[NhapXuatSach::class,'CTHoaDonXuat']);

// Sach trong kho
Route::get('/sachtrongkho',[SachController::class,'xuatsachtrongkho']);

// login logout
Route::post('/login',[AuthController::class,'login'] );

// get NamXuatBan , Daily
Route::get('/nxb',[SachController::class,'get_nxb']);
Route::get('/daily',[SachController::class,'get_daily']);

// dashboard v1
Route::get('/slsach',[SachController::class,'slsach']);
Route::get('/sohdnhap',[NhapXuatSach::class,'sohdnhap']);
Route::get('/sohdxuat',[NhapXuatSach::class,'sohdxuat']);
Route::get('/sokh',[KhachHangController::class,'sokhachhang']);

// dashboard v2
Route::get('/nhaptheothang',[NhapXuatSach::class,'nhaptheothang']);

// dashboard v3
Route::get('/sachbanchay',[SachController::class,'sachbanchay']);
Route::get('/hoadoncao',[NhapXuatSach::class,'hoadoncao']);




