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
<h3>分类添加</h3><a href="{{url('category')}}">列表</a><hr/>
<form class="form-horizontal" role="form" method="post" action="{{url('category/store')}}">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" name="cate_name" id="firstname"
                   placeholder="请输入分类名称">
            <b style="color:red">{{$errors->first('cate_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="radio" name="cate_show" id="lastname" value="1" checked>是
            <input type="radio" name="cate_show" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否导航栏显示</label>
        <div class="col-sm-10">
            <input type="radio" name="cate_nav_show" id="lastname" value="1"checked>是
            <input type="radio" name="cate_nav_show" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">父级分类</label>
        <div class="col-sm-10">
            <select name="parent_id" id="lastname">
                <option value="">__请选择__</option>
                 @foreach($cateinfo as $v)
                    <option value="{{$v->cate_id}}"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level*2);?>{{$v->cate_name}}</option>
                 @endforeach
            </select>
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