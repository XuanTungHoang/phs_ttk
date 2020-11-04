<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khachhang=KhachHang::all();
        return response()->json($khachhang,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=Validator::make($this->request,KhachHang::$rules_khachhang,KhachHang::$messages_khachhang);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            $khachhang=new KhachHang();
            $khachhang->TenKhachHang=$this->request['TenKhachHang'];
            $khachhang->DiaChi=$this->request['DiaChi'];
            $khachhang->SoDienThoai=$this->request['SoDienThoai'];
            $khachhang->IDLoaiKhachHang=$this->request['IDLoaiKhachHang'];
            $khachhang->TrangThai=$this->request['TrangThai'];
            $khachhang->save();
            if(!empty($khachhang)){
                return response()->json($khachhang,201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $khachhang = DB::table('khachhang')->where('IDKhachHang', $id)->first();
        if(empty($khachhang->TenKhachHang)){
            return response()->json(['Thong bao'=>'Khach hang khong ton tai !'],404);
        }else{
            return response()->json($khachhang,200);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $khachhang = DB::table('khachhang')->where('IDKhachHang', $id)->first();
        if(empty($khachhang->TenKhachHang)){
            return response()->json(['Thong bao'=>'Khach hang khong ton tai !'],404);
        }
        $validate=Validator::make($this->request,khachhang::$rules_khachhang,khachhang::$messages_khachhang);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            DB::table('khachhang')->where('IDKhachHang',$id)->update(array(
                'TenKhachHang'=>$this->request['TenKhachHang'],
                'DiaChi'=>$this->request['DiaChi'],
                'SoDienThoai'=>$this->request['SoDienThoai'],
                'IDLoaiKhachHang'=>$this->request['IDLoaiKhachHang'],
                'TrangThai'=>$this->request['TrangThai'],
            ));
            $khachhang=DB::table('khachhang')->where('IDKhachHang', $id)->first();
            if(!empty($khachhang->TenKhachHang)){
                return response()->json($khachhang,200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $khachhang = DB::table('khachhang')->where('IDKhachHang', $id)->first();
        if(empty($khachhang->TenKhachHang)){
            return response()->json(['Thong bao'=>'Khach hang khong ton tai !'],404);
        }else{
            DB::table('khachhang')->where('IDKhachHang', $id)->delete();
            return response()->json(['Thong bao'=>'Xoa khach hang thanh cong !'],200);
        }
    }
}
