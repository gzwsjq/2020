<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Successcontroller extends Controller{
    public function success(){
        return view('index.success');
    }
}
