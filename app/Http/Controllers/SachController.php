<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\Sach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sach=Sach::all();
        return response()->json($sach,200);
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
        $validate=Validator::make($this->request,Sach::$rules_sach,Sach::$messages_sach);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            $sach=new Sach();
            $sach->TenSach = $this->request['TenSach'];
            $sach->TacGia=$this->request['TacGia'];
            $sach->NhaXuatBan=$this->request['NhaXuatBan'];
            $sach->NamXuatBan=$this->request['NamXuatBan'];
            $sach->IDTheLoai=$this->request['IDTheLoai'];
            $sach->TomTat=$this->request['TomTat'];
            $sach->HinhAnh=$this->request['HinhAnh'];
            $sach->GiaNhap=$this->request['GiaNhap'];
            $sach->GiaBan=$this->request['GiaBan'];
            $sach->ConLai=0;
            $sach->DaBan=0;
            $sach->TrangThai=$this->request['TrangThai'];
            $sach->save();
            if(!empty($sach)){
                return response()->json($sach,201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sach  $sach
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sach = DB::table('sach')->where('IDSach', $id)->first();
        if(empty($sach->TenSach)){
            return response()->json(['Thong bao'=>'Khach hang khong ton tai !'],404);
        }else{
            return response()->json($sach,200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sach  $sach
     * @return \Illuminate\Http\Response
     */
    public function edit(Sach $sach)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sach  $sach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sach=DB::table('sach')->where('IDSach',$id)->first();
        $validate=Validator::make($this->request,Sach::$rules_sach,Sach::$messages_sach);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            DB::table('sach')->where('IDSach',$id)->update(array(
                'TenSach'=>$this->request['TenSach'],
                'TacGia'=>$this->request['TacGia'],
                'NhaXuatBan'=>$this->request['NhaXuatBan'],
                'NamXuatBan'=>$this->request['NamXuatBan'],
                'IDTheLoai'=>$this->request['IDTheLoai'],
                'TomTat'=>$this->request['TomTat'],
                'HinhAnh'=>$this->request['HinhAnh'],
                'GiaNhap'=>$this->request['GiaNhap'],
                'GiaBan'=>$this->request['GiaBan'],
                'TrangThai'=>$this->request['TrangThai'],
            ));
            $sach=DB::table('sach')->where('IDSach', $id)->first();
            if(!empty($sach->TenSach)){
                return response()->json($sach,200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sach  $sach
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sach = DB::table('sach')->where('IDSach', $id)->first();
        if(empty($sach->TenSach)){
            return response()->json(['Thong bao'=>'Sach khong ton tai !'],404);
        }else{
            DB::table('sach')->where('IDSach', $id)->delete();
            return response()->json(['Thong bao'=>'Xoa sach thanh cong !'],200);
        }
    }

    public function xuatsachtrongkho(){
        $sach=Sach::where('ConLai','>','0')->get();
        return response()->json($sach,200);
    }

    public function get_nxb(){
        $nxb=KhachHang::where('IDLoaiKhachHang',1)->get();
        return response()->json($nxb,200);
    }
    public function get_daily(){
        $daily=KhachHang::where('IDLoaiKhachHang',2)->get();
        return response()->json($daily,200);
    }

    public function slsach(){
        $sl=Sach::count();
        return response()->json(['sl'=>$sl]);
    }
    public function sachbanchay(){
        $sl = Sach::orderBy('DaBan','desc')->take(4)->get();
        return response()->json($sl,200);
    }
}
