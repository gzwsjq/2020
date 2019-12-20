<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller{
    public function login(){
        return view('index.login');
    }

    //执行登录
    public function dologin(Request $request){
        $post=request()->except('_token');
        $post['ctime']=time();
        $where=[
            ['name','=',$post['name']],
            ['pwd','=',$post['pwd']]
        ];
        $user=DB::table('qlogin')->where($where)->first();
        if($user){
            session(['user'=>$user]);
            request()->session()->save();
            echo "<script>alert('登录成功');location.href='/';</script>>";
        }else{
            echo "登录失败";
        }
    }

    //退出登录
    public function outlogin(){
        request()->session()->flush();//清除session
        echo "<script>alert('退出成功');location.href='/'</script>>";
    }

}
