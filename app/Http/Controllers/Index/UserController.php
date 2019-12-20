<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function user(){
        return view('index.user');
    }
}
