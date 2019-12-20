<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class Logincontroller extends Controller{
   public function dologin(){
       $post=request()->except('_token');


//       $user=DB::table('admin')->where($post)->first();
//
//       if($user){
//           session(['user'=>$user]);
//           request()->session()->save();
//
//           return redirect('/brand');
//       }


       if (Auth::attempt($post)) {
           //获取用户信息
//           $user=Auth::user();
//           dd($user);
         // 认证通过...
           return redirect('/brand');
       }else{
           return redirect('/login')->with('mc','账号或密码错误');
       }
   }
}
