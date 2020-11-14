<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NhapXuatSach extends Controller
{
    public function TaoPhieuNhap(){
        $validator = Validator::make($this->request, [
            'IDKhachHang' => 'required:numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['Thong bao' => $validator->errors()], 404);
        }
        
        if(empty($this->request['GhiChu'])){
            $this->request['GhiChu'] ='';
        }

        // Lay ngay gio hien tai
        $todayDate = date("Y-m-d");
        date_default_timezone_set('asia/ho_chi_minh');
        $time_now = date("H:i:s");

        // Tinh tong tien cho phieu nhap
        $tongtien =0.00;
        foreach($this->request['ChiTietSach'] as $sach){
            // Lay so luong sach hien tai
            $gianhap=DB::table('sach')->where('IDSach',$sach['IDSach'])->get();
            $gianhap=$gianhap[0]->GiaNhap;
            //return response()->json($soluong_hientai);
            $tongtien=$tongtien+ $gianhap*$sach['SoLuong'];
        }
       // return response()->json(gettype( $tongtien));
        $phieunhap= DB::table('phieunhap')->insert([
            'IDTaiKhoan'=>$this->request['IDTaiKhoan'],
            'IDKhachHang'=>$this->request['IDKhachHang'],
            'NgayNhap'=>$todayDate,
            'GioNhap'=>$time_now,
            'GhiChu'=>$this->request['GhiChu'],
            'TongTien'=>$tongtien,
        ]);
        if($phieunhap){
            // Lay id phieu nhap vua tao
            $last_id=DB::table('phieunhap')->max('IDPhieuNhap');
            //return response()->json($last_id);

            // lay ra tung sach va so luong
            foreach($this->request['ChiTietSach'] as $sach){
                DB::table('ctphieunhap')->insert([
                    'IDPhieuNhap'=>$last_id,
                    'IDSach'=>$sach['IDSach'],
                    'SoLuong'=>$sach['SoLuong'],
                ]);
            }

            
        }
        foreach($this->request['ChiTietSach'] as $sach){
            // Lay so luong sach hien tai
            $soluong_hientai=DB::table('sach')->where('IDSach',$sach['IDSach'])->get();
            $soluong_hientai=$soluong_hientai[0]->ConLai;
            //return response()->json($soluong_hientai);
            $soluong_nhapthem=$sach['SoLuong'];
            // Lay so luong moi de cap nhat
            $soluongmoi=(int)($soluong_hientai+$soluong_nhapthem);
           // return response()->json($soluongmoi);
            // Cap nhat so luong moi
            DB::table('sach')->where('IDSach', $sach['IDSach'])->update(array(
                'ConLai'=>$soluongmoi,
            ));
        }
        return response()->json('Tao phieu nhap thanh cong',200);
    }

    public function TaoPhieuXuat(){
        $validator = Validator::make($this->request, [
            'IDKhachHang' => 'required:numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['Thong bao' => $validator->errors()], 404);
        }
        
        if(empty($this->request['GhiChu'])){
            $this->request['GhiChu'] ='';
        }

        // Lay ngay gio hien tai
        $todayDate = date("Y-m-d");
        date_default_timezone_set('asia/ho_chi_minh');
        $time_now = date("H:i:s");

        $tongtien =0.00;
        foreach($this->request['ChiTietSach'] as $sach){
            // Lay so luong sach hien tai
            $giaxuat=DB::table('sach')->where('IDSach',$sach['IDSach'])->get();
            $giaxuat=$giaxuat[0]->GiaBan;
            //return response()->json($soluong_hientai);
            $tongtien=$tongtien+ $giaxuat*$sach['SoLuong'];
        }
        foreach($this->request['ChiTietSach'] as $sach){
            // Lay so luong sach hien tai
            $sach_object=DB::table('sach')->where('IDSach',$sach['IDSach'])->get();
            $soluong_conlai=$sach_object[0]->ConLai;
            if($soluong_conlai < $sach['SoLuong']){
                return response()->json('So luong sach khong du de xuat',404);
            }
        }
        $phieuxuat= DB::table('phieuxuat')->insert([
            'IDTaiKhoan'=>$this->request['IDTaiKhoan'],
            'IDKhachHang'=>$this->request['IDKhachHang'],
            'NgayXuat'=>$todayDate,
            'GioXuat'=>$time_now,
            'GhiChu'=>$this->request['GhiChu'],
            'TongTien'=>$tongtien,
        ]);

        if($phieuxuat){
            // Lay id phieu nhap vua tao
            $last_id=DB::table('phieuxuat')->max('IDPhieuXuat');
            //return response()->json($last_id);

            // lay ra tung sach va so luong
            foreach($this->request['ChiTietSach'] as $sach){
                DB::table('ctphieuxuat')->insert([
                    'IDPhieuXuat'=>$last_id,
                    'IDSach'=>$sach['IDSach'],
                    'SoLuong'=>$sach['SoLuong'],
                ]);
            }
        }

        foreach($this->request['ChiTietSach'] as $sach){
            // Lay so luong sach hien tai
            $soluong_hientai=DB::table('sach')->where('IDSach',$sach['IDSach'])->get();
            $soluong_conlai_hientai=$soluong_hientai[0]->ConLai;
            $soluong_daban_hientai=$soluong_hientai[0]->DaBan;
            //return response()->json($soluong_hientai);
            $soluong_xuat=$sach['SoLuong'];
            // Lay so luong moi de cap nhat
            $soluong_conlai_moi=(int)($soluong_conlai_hientai-$soluong_xuat);
            $soluong_daban_moi=(int)($soluong_daban_hientai+$soluong_xuat);
           // return response()->json($soluongmoi);
            // Cap nhat so luong moi
            DB::table('sach')->where('IDSach', $sach['IDSach'])->update(array(
                'ConLai'=>$soluong_conlai_moi,
                'DaBan'=>$soluong_daban_moi,
            ));
        }
        return response()->json('Tao phieu xuat thanh cong',200);
    }

}
