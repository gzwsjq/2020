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
<h3>品牌编辑</h3><a href="{{url('brand')}}">列表</a><hr/>
<form class="form-horizontal" role="form" method="post" action="{{url('brand/update/'.$data->bid)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="bname" value="{{$data->bname}}" id="firstname"
                   placeholder="请输入品牌名称">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌logo</label>
        <div class="col-sm-10">
            <img src="{{env('UPLOAD_URL')}}{{$data->blogo}}" width="100px" height="50px">
            <input type="file" class="form-control" name="blogo" value="{{$data->blogo}}" id="lastname"
                   placeholder="请输入品牌logo">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="burl" value="{{$data->burl}}" id="lastname"
                   placeholder="请输入品牌网址">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea placeholder="请输入品牌描述" class="form-control"  name="bdesc" id="lastname">{{$data->bdesc}}</textarea>
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