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
<h3>商品列表</h3><a href="{{url('goods/create')}}">添加</a><hr/>
{{--<b>{{session('mg')}}</b>--}}
<table class="table table-hover">
    <thead>
    <tr>
        <th>商品ID</th>
        <th>名称</th>
        <th>价格</th>
        <th>库存</th>
        <th>图片</th>
        <th>相册</th>
        <th>新品</th>
        <th>精品</th>
        <th>热卖</th>
        <th>品牌</th>
        <th>分类</th>
        <th>操作</th>
    </tr>
    </thead>
    @if($data)
        @foreach($data as $v)
            <tbody>
            <tr goods_id="{{$v->goods_id}}">
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_price}}</td>
                <td>{{$v->goods_num}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="100px" height="50px"></td>

                <td>
                    @foreach($v->goods_imgs as $vv)
                      <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="100px" height="50px">
                    @endforeach
                </td>

                <td field="is_new">
                    <span class="span_new" style="cursor:pointer">{{$v->is_new==1?'√':'×'}}</span>
                </td>
                <td field="is_best">
                    <span class="span_best" style="cursor:pointer">{{$v->is_best==1?'√':'×'}}</span>
                </td>
                <td field="is_hot">
                    <span class="span_hot" style="cursor:pointer">{{$v->is_hot==1?'√':'×'}}</span>
                </td>
                <td>{{$v->bid}}</td>
                <td>{{$v->cate_id}}</td>
                <td>
                    <a href="{{url('goods/delete/'.$v->goods_id)}}" class="btn btn-info">删除</a>
                    <a href="{{url('goods/edit/'.$v->goods_id)}}"  class="btn btn-info">编辑</a>
                </td>
            </tr>
            </tbody>
        @endforeach
    @endif
    <tr><td colspan="11">{{$data->links()}}</td></tr>
</table>

</body>
</html>
<script src="/static/jquery-3.2.1.min.js"></script>
<script>
    //精品,热卖,新品的即点即改的操作
    $(document).on('click','.span_new',function(){
        var _this=$(this);
        var _value=_this.text();//获取新值
        var _field=_this.parent().attr("field");
        var goods_id=_this.parents("tr").attr("goods_id");

        $.ajax({
            url:"{:url('goods/changewin')}",
            dataType:"json",
            type:"get",
            data:{
                _value:_value,
                _field:_field,
                goods_id:goods_id
            },
            success:function (reg) {
                if(reg=='1'){
                    if(_value=='√'){
                        _this.text('×');
                    }else if(_value=='×'){
                        _this.text('√');
                    }
                }
            }

        })
//        $.ajax({
//            method:'get',
//            url:"{:url('goods/changewin')}",
//            data:'{_value:_value,_field:_field,goods_id:goods_id}',
//       }).done(
//                function(reg){
//                    if(reg=='1'){
//                        if(_value=='√'){
//                            _this.text('×');
//                        }else if(_value=='×'){
//                            _this.text('√');
//                        }
//                    }
//                }
//        );
    });
</script>

