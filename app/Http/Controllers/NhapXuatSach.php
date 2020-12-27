<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NhapXuatSach extends Controller
{
    public function TaoPhieuNhap(){
        $arr = $this->request['ChiTietSach'];
        json_encode($arr);
        // print_r($a);
        // die('3');

        // $arr=array(
        //     array(
        //         'IDSach'=> array_keys($a[0]),
        //         'SoLuong'=> array_values($a[0]),
        //     ),
        //     array(
        //         'IDSach'=> array_keys($a[1]),
        //         'SoLuong'=> array_values($a[1]),
        //     ),
            
        // );
        // json_encode($arr);
       // print_r(array_values($a[0]));
      //  die('3');

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
        foreach($arr as $sach){
            // Lay so luong sach hien tai
            // print_r (array_keys($sach));
            // die('3');
            $gianhap=DB::table('sach')->where('IDSach',array_keys($sach))->get();
            
            $gianhap=$gianhap[0]->GiaNhap;
            $soluongsach=array_values($sach)[0];
         //   die('3');
            //return response()->json($soluong_hientai);
            $tongtien=$tongtien+ $gianhap*$soluongsach;
        }

        // print_r ($tongtien);
        // die('3');
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
            foreach($arr as $sach){
                $soluongsach=array_values($sach)[0];
                $idluongsach=array_keys($sach)[0];
                // print_r (array_keys($sach));
                // die('3');
                DB::table('ctphieunhap')->insert([
                    'IDPhieuNhap'=>$last_id,
                    'IDSach'=>$idluongsach,
                    'SoLuong'=>$soluongsach,
                ]);
            }
        }
        foreach($arr as $sach){
            // Lay so luong sach hien tai
            $soluong_hientai=DB::table('sach')->where('IDSach',array_keys($sach))->get();
            $soluong_hientai=$soluong_hientai[0]->ConLai;
            
            //return response()->json($soluong_hientai);
            $soluong_nhapthem=array_values($sach)[0];
            
            //$soluong_nhapthem=$sach['SoLuong'];
            // Lay so luong moi de cap nhat
            $soluongmoi=(int)($soluong_hientai+$soluong_nhapthem);
           // return response()->json($soluongmoi);
            // Cap nhat so luong moi
            // print_r ($soluongmoi);
            // die('3');
            DB::table('sach')->where('IDSach', array_keys($sach))->update(array(
                'ConLai'=>$soluongmoi,
            ));
        }
        return response()->json('Tao phieu nhap thanh cong',200);
    }

    public function TaoPhieuXuat(){
        $arr = $this->request['ChiTietSach'];
        json_encode($arr);

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
        foreach($arr as $sach){
            // Lay so luong sach hien tai
            $giaxuat=DB::table('sach')->where('IDSach',array_keys($sach))->get();
            $giaxuat=$giaxuat[0]->GiaBan;

            $soluongsach=array_values($sach)[0];
            // print_r($giaxuat);
            // die('3')
            //return response()->json($soluong_hientai);
            $tongtien=$tongtien+ $giaxuat*$soluongsach;
        }
        
        foreach($arr as $sach){
            // Lay so luong sach hien tai
            $sach_object=DB::table('sach')->where('IDSach',array_keys($sach))->get();
            $soluong_conlai=$sach_object[0]->ConLai;
            $soluongsach=array_values($sach)[0];
            if($soluong_conlai < $soluongsach){
                // print_r($soluong_conlai);
                // die('3');
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
            foreach($arr as $sach){
                $soluongsach=array_values($sach)[0];
                $idluongsach=array_keys($sach)[0];
                DB::table('ctphieuxuat')->insert([
                    'IDPhieuXuat'=>$last_id,
                    'IDSach'=>$idluongsach,
                    'SoLuong'=>$soluongsach,
                ]);
            }
        }

        foreach($arr as $sach){
            // Lay so luong sach hien tai
            $soluong_hientai=DB::table('sach')->where('IDSach',array_keys($sach))->get();
            $soluong_conlai_hientai=$soluong_hientai[0]->ConLai;
            $soluong_daban_hientai=$soluong_hientai[0]->DaBan;
            //return response()->json($soluong_hientai);
            $soluong_xuat=array_values($sach)[0];
            // Lay so luong moi de cap nhat
            $soluong_conlai_moi=(int)($soluong_conlai_hientai-$soluong_xuat);
            $soluong_daban_moi=(int)($soluong_daban_hientai+$soluong_xuat);
           // return response()->json($soluongmoi);
            // Cap nhat so luong moi
            DB::table('sach')->where('IDSach', array_keys($sach))->update(array(
                'ConLai'=>$soluong_conlai_moi,
                'DaBan'=>$soluong_daban_moi,
            ));
        }
        return response()->json('Tao phieu xuat thanh cong',200);
    }

    public function DSHoaDonNhap(){
        $hoadon=DB::table('phieunhap')->get();
        return response()->json($hoadon);
    }

    public function CTHoaDonNhap($id){
        // Lay thong tin nhan vien nhap va thong tin phieu nhap
        $nhanvien_phieunhap=DB::table('taikhoan')
        ->select('TenTaiKhoan','NgayNhap','GioNhap','TongTien','GhiChu')
        ->join('phieunhap','phieunhap.IDTaiKhoan','=','taikhoan.IDTaiKhoan')
        ->where('phieunhap.IDPhieuNhap',$id)
        ->get();

        // Lay thong tin khach hang trong phieu nhap
        $phieunhap_khachhang=DB::table('phieunhap')
        ->select('TenKhachHang')
        ->join('khachhang','khachhang.IDKhachHang','=','phieunhap.IDKhachHang')
        ->where('IDPhieuNhap',$id)
        ->get();

        // Lay chi tiet hoa don  cua phieu nhap
        $phieunhap_ctphieunhap=DB::table('ctphieunhap')
        ->join('sach','sach.IDSach','=','ctphieunhap.IDSach')
        ->where('IDPhieuNhap',$id)
        ->get();
        $chitiet=[];
        foreach ($phieunhap_ctphieunhap as $item){
            array_push($chitiet,[
                'IDSach'=>$item->IDSach,
                'TenSach'=>$item->TenSach,
                'GiaNhap'=>$item->GiaNhap,
                'SoLuong'=>$item->SoLuong,
            ]);
        }
        
        // Tra ve mot chi tiet phieu nhap hoan chinh
        $phieunhap=[
            'TenNhanVien'=>$nhanvien_phieunhap[0]->TenTaiKhoan,
            'TenKhachHang'=>$phieunhap_khachhang[0]->TenKhachHang,
            'NgayNhap'=>$nhanvien_phieunhap[0]->NgayNhap,
            'GioNhap'=>$nhanvien_phieunhap[0]->GioNhap,
            'GhiChu'=>$nhanvien_phieunhap[0]->GhiChu,
            'TongTien'=>$nhanvien_phieunhap[0]->TongTien,
            'ChiTiet'=>$chitiet,
        ];
        return response()->json($phieunhap);
    }
    
    public function DSHoaDonXuat(){
        $hoadon=DB::table('phieuxuat')->get();
        return response()->json($hoadon);
    }

    public function CTHoaDonXuat($id){
        // Lay thong tin nhan vien nhap va thong tin phieu nhap
        $nhanvien_phieuxuat=DB::table('taikhoan')
        ->select('TenTaiKhoan','NgayXuat','GioXuat','TongTien','GhiChu')
        ->join('phieuxuat','phieuxuat.IDTaiKhoan','=','taikhoan.IDTaiKhoan')
        ->where('phieuxuat.IDPhieuXuat',$id)
        ->get();

        // Lay thong tin khach hang trong phieu nhap
        $phieuxuat_khachhang=DB::table('phieuxuat')
        ->select('TenKhachHang')
        ->join('khachhang','khachhang.IDKhachHang','=','phieuxuat.IDKhachHang')
        ->where('IDPhieuXuat',$id)
        ->get();

        // Lay chi tiet hoa don  cua phieu nhap
        $phieuxuat_ctphieuxuat=DB::table('ctphieuxuat')
        ->join('sach','sach.IDSach','=','ctphieuxuat.IDSach')
        ->where('IDPhieuXuat',$id)
        ->get();
        $chitiet=[];
        foreach ($phieuxuat_ctphieuxuat as $item){
            array_push($chitiet,[
                'IDSach'=>$item->IDSach,
                'TenSach'=>$item->TenSach,
                'GiaBan'=>$item->GiaBan,
                'SoLuong'=>$item->SoLuong,
            ]);
        }
        
        // Tra ve mot chi tiet phieu nhap hoan chinh
        $phieuxuat=[
            'TenNhanVien'=>$nhanvien_phieuxuat[0]->TenTaiKhoan,
            'TenKhachHang'=>$phieuxuat_khachhang[0]->TenKhachHang,
            'NgayXuat'=>$nhanvien_phieuxuat[0]->NgayXuat,
            'GioXuat'=>$nhanvien_phieuxuat[0]->GioXuat,
            'GhiChu'=>$nhanvien_phieuxuat[0]->GhiChu,
            'TongTien'=>$nhanvien_phieuxuat[0]->TongTien,
            'ChiTiet'=>$chitiet,
        ];
        return response()->json($phieuxuat);
    }

    public function sohdnhap(){
        $hd=DB::table('phieunhap')->count();
        return response()->json($hd,200);
    }
    public function sohdxuat(){
        $hd=DB::table('phieuxuat')->count();
        return response()->json($hd,200);
    }

    public function nhaptheothang(){
        // $data=DB::table('phieunhap')->select("IDPhieuNhap" ,DB::raw("(COUNT(*)) as total_click"))
        // ->orderBy('created_at')
        // ->groupBy(DB::raw("MONTH(created_at)"))
        // ->get();
        return 0;
    }

    public function hoadoncao(){
        $sl = DB::table('phieuxuat')->orderBy('TongTien','desc')->take(4)->get();
        // print_r($sl[0]->IDPhieuXuat);
        // die('3');
        // $phieuxuat_khachhang=DB::table('phieuxuat')
        // ->select('TenKhachHang')
        // ->join('khachhang','khachhang.IDKhachHang','=','phieuxuat.IDKhachHang')
        // ->where('IDPhieuXuat',$id)
        // ->get();
        return response()->json($sl,200);
    }

}
