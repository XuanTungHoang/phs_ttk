<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //protected $dataSendView=[];
    protected $request =[];

    public function __construct()
    {
        //$this->check_Login();
        //view()->share('user_Login',Auth::user());
        $this->request=request()->all();
        //$this->limit=5;
    }
}
