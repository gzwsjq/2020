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
<h3>文章添加</h3><a href="{{url('one')}}">列表</a><hr/>
<form class="form-horizontal" role="form" method="post" action="{{url('one/update/'.$data->sid)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章标题</label>
        <div class="col-sm-10">
            <input type="text" name="stitle" id="firstname" value="{{$data->stitle}}"
                   placeholder="请输入文章标题">
            <b style="color:red">{{$errors->first('stitle')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章分类</label>
        <div class="col-sm-10">
            <select name="id" id="lastname">
                <option value="">__请选择__</option>
                @foreach($tail as $v)
                    <option value="{{$v->id}}" @if($data->id==$v->id){{'selected'}} @endif>{{$v->tname}}</option>
                @endforeach
            </select>
            <b style="color:red">{{$errors->first('id')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
        <div class="col-sm-10">
            @if(($data->scom)=='普通')
                <input type="radio" name="scom" id="lastname" value="普通" checked>普通
                <input type="radio" name="scom" id="lastname" value="置顶">置顶
                @else
                <input type="radio" name="scom" id="lastname" value="普通">普通
                <input type="radio" name="scom" id="lastname" value="置顶" checked>置顶
                @endif
                <b style="color:red">{{$errors->first('scom')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            @if(($data->sshow)==1)
                <input type="radio" name="sshow" id="lastname" value="1" checked>显示
                <input type="radio" name="sshow" id="lastname" value="2">不显示
                @else
                <input type="radio" name="sshow" id="lastname" value="1">显示
                <input type="radio" name="sshow" id="lastname" value="2" checked>不显示
            @endif
                <b style="color:red">{{$errors->first('sshow')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-10">
            <input type="text" name="speo" id="firstname" value="{{$data->speo}}"
                   placeholder="请输入文章作者">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">作者email</label>
        <div class="col-sm-10">
            <input type="text" name="semail" id="firstname" placeholder="请输入作者邮箱" value="{{$data->semail}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">关键字</label>
        <div class="col-sm-10">
            <input type="text" name="skey" id="firstname" placeholder="请输入关键字" value="{{$data->skey}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">网页描述</label>
        <div class="col-sm-10">
            <textarea name="sdesc" id="firstname">{{$data->sdesc}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">图片logo</label>
        <div class="col-sm-10">
            <img src="{{env('UPLOAD_URL')}}{{$data->slogo}}" width="100px" height="50px">
            <input type="file" name="slogo" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">编辑</button>
        </div>
    </div>
</form>

</body>
</html>