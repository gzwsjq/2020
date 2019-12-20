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
<form class="form-horizontal" role="form" method="post" action="{{url('one/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章标题</label>
        <div class="col-sm-10">
            <input type="text" name="stitle" id="firstname" class="stitle"
                   placeholder="请输入文章标题">
            <b style="color:red">{{$errors->first('stitle')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章分类</label>
        <div class="col-sm-10">
            <select name="id" id="lastname" class="id">
                <option value="">__请选择__</option>
                @foreach($tail as $v)
                    <option value="{{$v->id}}">{{$v->tname}}</option>
                    @endforeach
            </select>
            <b style="color:red">{{$errors->first('id')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
        <div class="col-sm-10">
            <input type="radio" name="scom" id="lastname" value="普通" checked>普通
            <input type="radio" name="scom" id="lastname" value="置顶">置顶
            <b style="color:red">{{$errors->first('scom')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="radio" name="sshow" id="lastname" value="1" checked>显示
            <input type="radio" name="sshow" id="lastname" value="2">不显示
            <b style="color:red">{{$errors->first('sshow')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-10">
            <input type="text" name="speo" id="firstname"
                   placeholder="请输入文章作者">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">作者email</label>
        <div class="col-sm-10">
            <input type="text" name="semail" id="firstname" placeholder="请输入作者邮箱">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">关键字</label>
        <div class="col-sm-10">
            <input type="text" name="skey" id="firstname" placeholder="请输入关键字">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">网页描述</label>
        <div class="col-sm-10">
            <textarea name="sdesc" id="firstname"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">图片logo</label>
        <div class="col-sm-10">
           <input type="file" name="slogo" id="firstname">
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
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>\
<script>
    $(function(){
        //文章标题
        $(document).on('click','.stitle',function(){
            var stitle=$('.stitle').val();
            var reg=/^[\u4e00-\u9fa5]$/;
            if(stitle==''){
                alert('文章标题必填');
                return false;
            }else if(!reg.test(stitle)){
                alert('文章标题由数字字母下划线组成');
                return false;
            }
        });
        //分类
        $(document).on('click','.id',function(){
            var _this=$(this);
            var id=$('.id').val();
            if(id==''){
                alert('分类必填');
                return false;
            }
        });
    });
</script>