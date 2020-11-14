<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    use HasFactory;
    protected $table = 'sach';

    public static $rules_sach =[
        'TenSach'=>'required|unique:sach',
        'TacGia'=>'required',
        'NhaXuatBan'=>'required',
        'NamXuatBan'=>'required|numeric',
        'IDTheLoai'=>'required|numeric',
        'TomTat'=>'required',
        'HinhAnh'=>'required',
        'GiaNhap'=>'required|numeric',
        'GiaBan'=>'required|numeric',
        'TrangThai'=>'required|numeric',
    ];

    public static $messages_sach =[
        'TenSach.required'=>'Ten sach khong duoc de trong',
        'TenSach.unique'=>'Ten sach da ton tai',
        'TacGia.required'=>'Ten tac gia khong duoc de trong',
        'NhaXuatBan.required'=>'Nam xuat ban khong duoc de trong',
        'NamXuatBan.numeric'=>'Nam xuat ban phai la ki tu so',
        'IDTheLoai.required'=>'The loai sach khong duoc de trong',
        'TomTat.required'=>'Tom tat sach khong duoc de trong',
        'HinhAnh.required'=>'Hinh anh sach khong duoc de trong',
        'GiaNhap.required'=>'Gia nhap sach khong duoc de trong',
        'GiaNhap.numeric'=>'Gia nhap sach phai la ki tu so',
        'GiaBan.numeric'=>'Gia ban sach phai la ki tu so',
        'GiaBan.required'=>'Gia ban sach khong duoc de trong',
        'TrangThai.required'=>'Trang thai phai la ki tu so',
        'TrangThai.numeric'=>'Trang thai phai la ki tu so',
    ];
}
