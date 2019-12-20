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
<h3>商品列表</h3><a href="{{url('one/create')}}">添加</a><hr/>
<b>{{session('mo')}}</b>
<form action="" method="">
    <input type="text" name="stitle" placeholder="请输入文章标题" value="{{$query['stitle']??''}}">
    <select name="id" id="lastname">
        <option value="">__请选择__</option>
        @foreach($tail as $v)
            <option value="{{$v->id}}">{{$v->tname}}</option>
            @endforeach
    </select>
    <input type="submit" value="搜索">
</form>
<table class="table table-hover">
    <thead>
    <tr>
        <th>编号</th>
        <th>文章标题</th>
        <th>文章分类</th>
        <th>文章重要性</th>
        <th>是否显示</th>
        <th>添加日期</th>
        <th>图片logo</th>
        <th>操作</th>
    </tr>
    </thead>
    @if($data)
        @foreach($data as $v)
            <tbody>
            <tr sid="{{$v->sid}}">
                <td>{{$v->sid}}</td>
                <td>{{$v->stitle}}</td>
                <td>{{$v->tname}}</td>
                <td>{{$v->scom}}</td>
                <td>{{$v->sshow==1?'√':'×'}}</td>
                <td style="color:red">{{date('Y-m-d H:i:s',$v->stime)}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->slogo}}" width="100px" height="50px"></td>
                <td>
                    <a href="{{url('one/delete/'.$v->sid)}}" class="btn btn-info">删除</a>
                    <a href="{{url('one/edit/'.$v->sid)}}"  class="btn btn-info">编辑</a>
                </td>
            </tr>
            </tbody>
        @endforeach
    @endif
    <tr><td colspan="8">{{$data->appends($query)->links()}}</td></tr>
</table>

</body>
</html>
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //删除 给类为del绑定点击事件
        $(document).on('click','.del',function(){
        if(window.confirm('是否确认删除')){
        //获取分类id
        var _this=$(this);
        var sid=_this.parents("tr").attr('sid');
        location.href="{{url('one/destroy/')}}?sid="+sid;
        }
        });
    });
</script>







