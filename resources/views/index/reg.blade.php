        @extends('layouts.shop')
        @section('title', '注册')
        @section('content')
            <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/regdo')}}" method="post" class="reg-login">
         @csrf
      <h3>已经有账号了？点此<a class="orange" href="">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="utel" id="tel" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="ucode" placeholder="输入短信验证码" /> <button type="button" id="button">获取验证码</button></div>
       <div class="lrList"><input type="text" name="upwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text"  name="upwd1" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
        @endsection
        <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
        <script>
            $(function(){
               $(document).on('click',"#button",function(){
                 var tel= $("#tel").val();
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.post(
                           "{{url('/sendtel')}}",
                            {tel:tel},
                             function(res){
                                 if(res=='ok'){
                                     alert('发送成功');
                                 }else{
                                     alert('发送失败');
                                 }
                             }
                   )
               });
            });
        </script>