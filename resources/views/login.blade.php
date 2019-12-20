<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<h3>登录</h3>
<b style="color:red">{{session('mc')}}</b>
<form class="form-horizontal" role="form" method="post" action="{{url('dologin')}}">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
            <input type="text" name="name" id="firstname" class="account"
                   placeholder="请输入用户名">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="text" name="password" id="firstname" class="pwd"
                   placeholder="请输入密码">
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">登录</button>
        </div>
    </div>
</form>

</body>
</html>
<script src="/static/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //账号
        $(document).on("click",".account",function(){
            var account=$(".account").val();
            if(account==''){
                alert('账号必填');
                return false;
            }
        });
        //密码
        $(document).on("click",".pwd",function(){
            var pwd=$(".pwd").val();
            if(pwd==''){
                alert('密码必填');
                return false;
            }
        });
    });
</script>