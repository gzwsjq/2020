<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function login(){
        return view('index/login');
    }

    public function logindo(Request $request){
       $post=$request->name;
        dd($post);
    }
}
