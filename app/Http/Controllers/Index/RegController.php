<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Model\user;

class RegController extends Controller{
    public function reg(){
        return view('index.reg');
    }

    public function sendsms($tel,$code){
        AlibabaCloud::accessKeyClient('LTAI4FpqoYDEGxv6f1ctbZ3e', 'hoCMI1x1eLWxP8YITt2y8tZAvMgj66')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => "$tel",
                        'SignName' => "乐柠",
                        'TemplateCode' => "SMS_176535909",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
           // print_r($result->toArray());
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
        return true;

    }

    public function sendtel(){
         $tel=request()->tel;
          $code=rand(100000,999999);
          //$res=$this->sendsms($tel,$code);
          $res=true;
           if($res){
               session(['telinfo'=>['tel'=>$tel,'code'=>$code]]);
               request()->session()->save();
               echo 'ok';
           }else{
               echo 'no';
           }
    }

        public function regdo(){
            $post=request()->except('_token');
            $session=session('telinfo');
            $tel= $session['tel'];
            $code= $session['code'];
        //验证手机号
        if($post['utel']!=$session['tel']){
            echo "发送验证码手机号与注册的手机号不一致";die;
        }
        //验证验证码
        if($post['ucode']!=$session['code']){
            echo "验证码有误";die;
        }
        //验证密码
       if($post['upwd']!=$post['upwd1']){
           echo '密码必须与确认密码保持一致';die;
       }
        //载入数据库
        $post['upwd']=Bcrypt($post['upwd']);
        $post['utime']=time();
//        $aaa = [
//            ['utel'=>$tel],
//            ['upwd'=>$post['upwd']],
//            ['ucode'=>$code],
//        ];
       $user = new  User;
            $user->utel = $post['utel'];
            $user->upwd = $post['upwd'];
            $user->ucode = $post['ucode'];
            $user->utime = $post['utime'];
           $res= $user-> save();;

        if($res){
            echo "<script>alert('注册成功');location.href='/';</script>>";
        }else{
            echo "注册失败";
        }
}
 public function test(){
     $info=session('telinfo');
     dd($info);
 }





}
