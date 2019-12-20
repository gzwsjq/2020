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
<h3>商品添加</h3><a href="{{url('goods')}}">列表</a><hr/>
<form class="form-horizontal" role="form" method="post" action="{{url('goods/store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" name="goods_name" id="firstname"
                   placeholder="请输入商品名称">
            <b style="color:red">{{$errors->first('goods_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
            <input type="text" name="goods_price" id="firstname"
                   placeholder="请输入商品价格">
            <b style="color:red">{{$errors->first('goods_price')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-10">
            <input type="text" name="goods_num" id="firstname"
                   placeholder="请输入商品库存">
            <b style="color:red">{{$errors->first('goods_num')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品货号</label>
        <div class="col-sm-10">
            <input type="text" name="goods_no" id="firstname"
                   placeholder="请输入商品货号">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-10">
            <input type="file" name="goods_img" id="firstname"
                   placeholder="请输入商品图片">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-10">
            <input type="file" name="goods_imgs[]" id="firstname" multiple>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品详情</label>
        <div class="col-sm-10">
            <textarea name="goods_desc" placeholder="请输入商品详情" id="firstname"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品积分</label>
        <div class="col-sm-10">
            <input type="text" name="goods_score" id="firstname"
                   placeholder="请输入商品积分">
            <b style="color:red">{{$errors->first('goods_score')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否新品</label>
        <div class="col-sm-10">
            <input type="radio" name="is_new" id="lastname" value="1" checked>是
            <input type="radio" name="is_new" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-10">
            <input type="radio" name="is_best" id="lastname" value="1"checked>是
            <input type="radio" name="is_best" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否热卖</label>
        <div class="col-sm-10">
            <input type="radio" name="is_hot" id="lastname" value="1"checked>是
            <input type="radio" name="is_hot" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否上架</label>
        <div class="col-sm-10">
            <input type="radio" name="is_up" id="lastname" value="1"checked>是
            <input type="radio" name="is_up" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌</label>
        <div class="col-sm-10">
            <select name="bid" id="lastname">
                <option value="">__请选择__</option>
                @foreach($brand as $v)
                    <option value="{{$v->bid}}">{{$v->bname}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-10">
            <select name="cate_id" id="lastname">
                <option value="">__请选择__</option>
                @foreach($cate as $v)
                    <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
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