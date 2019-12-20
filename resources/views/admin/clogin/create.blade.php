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
<h3>管理添加</h3> <a href="{{url('clogin')}}">列表</a><hr/>

<form class="form-horizontal" role="form" method="post" action="{{url('clogin/store')}}" enctype="multipart/form-data" id="myform">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="account" id="firstname"
                   placeholder="请输入账号">
            <b style="color:red">{{$errors->first('account')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control pwd" name="pwd" id="lastname"
                   placeholder="请输入密码">
            <b style="color:red">{{$errors->first('pwd')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="img" id="lastname"
                   placeholder="请上传头像">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>

</body>
</html>
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        $(document).on("submit","#myform",function(){
            //验证账号
            var account=$("#firstname").val();
             if(account==''){
                 alert('账号必填');
                 return false;
             }
           //验证密码
            var pwd=$(".pwd").val();
//            if(pwd==''){
//                alert('密码必填');
//                return false;
//            }
        });
    });
</script>