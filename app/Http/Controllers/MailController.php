<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Sendcode;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller{
    public function send_email(){
        Mail::to('2281401451@qq.com')->send(new Sendcode());
    }
}
