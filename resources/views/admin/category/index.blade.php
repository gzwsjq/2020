<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h3>分类列表</h3><a href="{{url('category/create')}}">添加</a><hr/>
<b>{{session('mg')}}</b>
<table class="table table-hover">
    <thead>
    <tr>
        <th>分类ID</th>
        <th>分类名称</th>
        <th>是否显示</th>
        <th>是否导航栏显示</th>
        <th>操作</th>
    </tr>
    </thead>
    @if($data)
        @foreach($data as $v)
    <tbody>
            <tr cate_id="{{$v->cate_id}}" parent_id="{{$v->parent_id}}" style="display:none;">
                <td>
                    <?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level*2);?>
                    <a href="javascript:;" class="sign"><strong>+</strong></a>
                    {{$v->cate_id}}
                </td>
                <td field="cate_name">
                        <?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level*2);?>
                        <span class="span_name">{{$v->cate_name}}</span>
                        <input type="text" value="{{$v->cate_name}}" class="changeName" style="display:none">
                </td>
                <td field="cate_show">
                    <span class="span_show" style="cursor:pointer">{{$v->cate_show==1?'√':'×'}}</span>
                </td>
                <td field="cate_nav_show">
                    <span class="span_show" style="cursor:pointer">{{$v->cate_nav_show==1?'√':'×'}}</span>
                </td>
                <td>
                    <a href="{{url('category/delete/'.$v->cate_id)}}" class="btn btn-info">删除</a>
                    <a href="{{url('category/edit/'.$v->cate_id)}}"  class="btn btn-info">编辑</a>
                </td>
            </tr>
    </tbody>
        @endforeach
        @endif
</table>

</body>
</html>
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //加减号的收缩
        //页面加载中获取parent_id=0  显示
        $("tr[parent_id=0]").show();
        //点击符号
        $(document).on('click','.sign',function(){
            var _this=$(this);//当前超链接标签
            var sign=_this.text();//获取当前文本
            var cate_id=_this.parents("tr").attr('cate_id');
            if(sign=='+'){
                if($("tr[parent_id="+cate_id+"]").length>0){
                    $("tr[parent_id="+cate_id+"]").show();
                    _this.text('-');
                }
            }else{
                $("tr[parent_id="+cate_id+"]").hide();
                _this.text('+');
            }
        });
        //即点即改
        $(document).on("click",".span_name",function(){
            var _this=$(this);
            _this.hide();
            _this.next("input").show().focus();
        });

        $(document).on("blur",".changeName",function(){
            var _this=$(this);
            var value=_this.val();///获取新值
            var field=_this.parent().attr("field");//获取字段
            var cate_id=_this.parents("tr").attr("cate_id");//获取id

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: "/category/changeName",
                data: {value:value,field:field,cate_id:cate_id}
            }).done(
                    function (res) {
                        if (res == 'ok') {
                            _this.prev("span").text(_value).show();
                            _this.hide();
                        } else {
                            _this.prev("span").show();
                            _this.hide();
                        }
                    }
            );
        });

        //是否显示的即点即改
        $(document).on("click",".span_show",function(){
            var _this=$(this);//当前点击的span标签
            var _value=_this.text(); //获取新值
            var _field=_this.parent().attr("field");//获取字段
            var cate_id=_this.parents("tr").attr("cate_id");//获取分类id
//            console.log(_value);
//            console.log(_field);
//            console.log(cate_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: "/category/changewin",
                data: {_value:_value,_field:_field,cate_id:cate_id}
            }).done(
                    function (res) {
                        if (res == '1') {
                            if (_value == "√") {
                                _this.text("×");
                            } else if (_value == "×") {
                                _this.text("√");
                            }
                        }
                    });
        });

    });
</script>


