<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return response()->json($users,200);
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
       // return response()->json($this->request);
        $validate=Validator::make($this->request,User::$rules,User::$messages);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            $user=new User();
            $user->TenDangNhap=$this->request['TenDangNhap'];
            $user->MatKhau=Hash::make($this->request['MatKhau']);
            $user->TenTaiKhoan=$this->request['TenTaiKhoan'];
            $user->GioiTinh=$this->request['GioiTinh'];
            $user->SoDienThoai=$this->request['SoDienThoai'];
            $user->IDLoaiTaiKhoan=$this->request['IDLoaiTaiKhoan'];
            $user->TrangThai=$this->request['TrangThai'];
            $user->save();
            if(!empty($user)){
                return response()->json($user,201);
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
        $user = DB::table('taikhoan')->where('IDTaiKhoan', $id)->first();
        if(empty($user->TenTaiKhoan)){
            return response()->json(['Thong bao'=>'Tai khoan khong ton tai !'],404);
        }else{
            return response()->json($user,200);
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
        $user = DB::table('taikhoan')->where('IDTaiKhoan', $id)->first();
        if(empty($user->TenDangNhap)){
            return response()->json(['Thong bao'=>'Tai khoan khong ton tai !'],404);
        }
        $validate=Validator::make($this->request,User::$rules,User::$messages);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            DB::table('taikhoan')->where('IDTaiKhoan',$id)->update(array(
                'TenDangNhap'=>$this->request['TenDangNhap'],
                'MatKhau'=>Hash::make($this->request['MatKhau']),
                'TenTaiKhoan'=>$this->request['TenTaiKhoan'],
                'GioiTinh'=>$this->request['GioiTinh'],
                'SoDienThoai'=>$this->request['SoDienThoai'],
                'IDLoaiTaiKhoan'=>$this->request['IDLoaiTaiKhoan'],
                'TrangThai'=>$this->request['TrangThai'],
            ));
            $user = DB::table('taikhoan')->where('IDTaiKhoan', $id)->first();
            if(!empty($user->TenDangNhap)){
                return response()->json($user,200);
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
        $user = DB::table('taikhoan')->where('IDTaiKhoan', $id)->first();
        if(empty($user->TenDangNhap)){
            return response()->json(['Thong bao'=>'Tai khoan khong ton tai !'],404);
        }else{
            DB::table('taikhoan')->where('IDTaiKhoan', $id)->delete();
            return response()->json(['Thong bao'=>'Xoa tai khoan thanh cong !'],200);
        }
        
    }
}
