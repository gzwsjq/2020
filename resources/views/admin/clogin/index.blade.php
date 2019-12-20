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
<h3>管理列表</h3><a href="{{url('clogin/create')}}">添加</a><hr/>
<b>{{session('io')}}</b>
<table class="table table-hover">
    <thead>
    <tr class="success">
        <th>ID</th>
        <th>账号</th>
        <th>密码</th>
        <th>头像</th>
        <th>登录ip</th>
        <th>登录时间</th>
        <th>操作</th>
    </tr>
    </thead>
    @if($data)
        @foreach($data as $v)
    <tbody>
            <tr class="warning">
                <td>{{$v->id}}</td>
                <td>{{$v->account}}</td>
                <td>{{$v->pwd}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="100px" height="50px"></td>
                <td>{{$v->login_ip}}</td>
                <td>{{$v->login_time}}</td>
                <td>
                    <a href="{{url('clogin/delete/'.$v->id)}}" class="btn btn-info">删除</a>
                    <a href="{{url('clogin/edit/'.$v->id)}}"  class="btn btn-info">编辑</a>
                </td>
            </tr>
    </tbody>
        @endforeach
        @endif
</table>



</body>
</html>