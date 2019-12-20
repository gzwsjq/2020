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
<h3>品牌列表</h3><a href="{{url('brand/create')}}">添加</a><hr/>
<b>{{session('nbg')}}</b>
{{--<center style="color:red">欢迎{{$user=Auth::user()->name}}登录</center>--}}
<form action="" method="">
    <input type="text" name="bname" placeholder="请输入品牌名称" value="{{$query['bname']??''}}">
    <input type="text" name="burl" placeholder="请输入品牌网址" value="{{$query['burl']??''}}">
    <input type="submit" value="搜索">
</form>
<table class="table table-hover">
    <thead>
    <tr class="success">
        <th>品牌ID</th>
        <th>品牌名称</th>
        <th>品牌logo</th>
        <th>品牌网址</th>
        <th>品牌描述</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if($data)
        @foreach($data as $v)
            <tr class="warning">
                <td>{{$v->bid}}</td>
                <td>{{$v->bname}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->blogo}}" width="100px" height="50px"></td>
                <td>{{$v->burl}}</td>
                <td>{{$v->bdesc}}</td>
                <td>
                    <a href="{{url('brand/delete/'.$v->bid)}}" class="btn btn-info">删除</a>
                    <a href="{{url('brand/edit/'.$v->bid)}}"  class="btn btn-info">编辑</a>
                </td>
            </tr>
        @endforeach
    @endif
    <tr><td colspan="6">{{$data->appends($query)->links()}}</td></tr>
    </tbody>
</table>



</body>
</html>