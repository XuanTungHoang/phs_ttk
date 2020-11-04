<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'taikhoan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $rules =[
        'TenDangNhap'=>'required|unique:taikhoan',
        'MatKhau'=>'required|min:6',
        'TenTaiKhoan'=>'required',
        'GioiTinh'=>'required',
        'SoDienThoai'=>'required|numeric',
        'IDLoaiTaiKhoan'=>'required|numeric',
        'TrangThai'=>'required|numeric',
    ];
    public static $messages =[
        'TenDangNhap.required'=>'Ten dang nhap khong duoc de trong',
        'TenDangNhap.unique'=>'Ten dang nhap da ton tai',
        'MatKhau.required'=>'Mat khau khong duoc de trong',
        'MatKhau.min'=>'Mat khau phai co it nhat 6 ki tu',
        'TenTaiKhoan.required'=>'Ten tai khoan khong duoc de trong',
        'SoDienThoai.required'=>'So dien thoai khong duoc de trong',
        'SoDienThoai.numeric'=>'So dien thoai phai la ki tu so',
        'GioiTinh.required'=>'Gioi tinh khong duoc de trong',
        'IDLoaiTaiKhoan.required'=>'Loai tai khoan khong duoc de trong',
        'IDLoaiTaiKhoan.numeric'=>'Loai tai khoan phai la ki tu so',
        'TrangThai.required'=>'Trang thai khong duoc de trong',
        'TrangThai.numeric'=>'Trang thai phai la ki tu so',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
