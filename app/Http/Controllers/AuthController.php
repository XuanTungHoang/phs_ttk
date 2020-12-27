<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
       // return '123';
        // print_r($request->TenDangNhap);
        // die('3');
        $user= User::where('TenDangNhap',$request->TenDangNhap)->first();
        if(!empty($user)){
            if($user->MatKhau=Hash::make($this->request['MatKhau'])){
                DB::table('taikhoan')->where('TenDangNhap',$request->TenDangNhap)->update(array(
                    'TrangThai'=> 1 ,
                ));
                return $user;
            }   else{
                return 0;
            }
        }else{
            return 0;
        }



       // return response()->json($user->TenDangNhap);

        // if (Auth::attempt(['TenDangNhap' => $request->TenDangNhap, 'MatKhau' => $request->MatKhau])) {
        //     return 'true';
        // }else{
        //     return '0';
        // }
        
        
        
    }
}
