<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function get_Login(){
        return view('login');
    }

    public function post_Login(Request $request){
        //  print_r($request->input_pass);
        // die('3');
        if (Auth::attempt(['email' => $request->input_name, 'password' => $request->input_pass])) {
            // The user is active, not suspended, and exists.
            return 'true';
        }else{
            return '0';
        }
        
        
        
    }
}
