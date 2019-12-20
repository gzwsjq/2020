<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function index(){
        return view('index/index');
    }

    public function good($id){
       echo $id;
    }
}
