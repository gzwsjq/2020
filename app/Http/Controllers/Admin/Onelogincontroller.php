<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Onelogincontroller extends Controller{
    public function dlogin(){
        $post=request()->except('_token');
        $use=DB::table('admin')->where($post)->first();

        if($use){
            session(['use'=>$use]);
            request()->session()->save();

            return redirect('/one');
        }
    }
}
