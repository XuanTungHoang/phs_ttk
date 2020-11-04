<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;
    protected $table = 'khachhang';

    public static $rules_khachhang =[
        'TenKhachHang'=>'required|unique:khachhang',
        'DiaChi'=>'required',
        'SoDienThoai'=>'required|numeric',
        'IDLoaiKhachHang'=>'required|numeric',
        'TrangThai'=>'required|numeric',
    ];
    public static $messages_khachhang =[
        'TenKhachHang.required'=>'Ten khach hang khong duoc de trong',
        'TenKhachHang.unique'=>'Ten khach hang da ton tai',
        'DiaChi.required'=>'Dia chi khach hang khong duoc de trong',
        'SoDienThoai.required'=>'So dien thoai khong duoc de trong',
        'SoDienThoai.numeric'=>'So dien thoai phai la ki tu so',
        'IDLoaiKhachHang.required'=>'Loai tai khoan khong duoc de trong',
        'IDLoaiKhachHang.numeric'=>'Loai tai khoan phai la ki tu so',
        'TrangThai.required'=>'Trang thai khong duoc de trong',
        'TrangThai.numeric'=>'Trang thai phai la ki tu so',
    ];
}
