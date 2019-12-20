@extends('layouts.shop')
@section('title', '购物车')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->

    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange"></strong>件商品</span></td>
            {{--<td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">--}}
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>

    <div class="dingdanlist">
        <table>
            <tr>
                <td width="100%" colspan="4"><input type="checkbox" name="1" id="allbox"/>全选</td>
            </tr>
            @foreach($goodsInfo as $v)
                <tr goods_id="{{$v->goods_id}}" goods_num="{{$v->goods_num}}">
                    <td width="4%"><input type="checkbox" class="box"/></td>
                    <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" /></td>
                    <td width="50%">
                        <h3>{{$v->goods_name}}</h3>
                        <time>下单时间：{{date('Y-m-d h:i:s',$v->add_time)}}</time>
                    </td>
                    <td align="right">
                        <input type="button" class="less" value="-" style="width:30px;text-align:center;"/>
                        <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number" style="width:30px; color:#00ffff; text-align:center;"/>
                        <input type="button" class="add" value="+" style="width:30px;text-align:center;"/>
                    </td>
                    <td colspan="4" style="color:#ff4e00;">¥<span class="total">{{$v->goods_price*$v->buy_number}}</span></td>
                    <td><a class="del" style="white-space:nowrap">删除</a></td>
                </tr>
            @endforeach
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;" id="delmany">批量删除</a></td>
            </tr>
        </table>
    </div><!--dingdanlist/-->
    <table>
        <tr>
            <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
            <td width="50%">总计：<span class="orange" id="money">￥0</span></td>&nbsp;&nbsp;&nbsp;
            <td width="40%"><button style="color:green" class="submit">去结算</button></td>

        </tr>
    </table>

    </div><!--dingdanlist/-->
    <div class="height1"></div>
    <div class="gwcpiao">
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>
    <!--jq加减-->
    <script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
    <script>
        $('.spinnerExample').spinner({});
    </script>
    </body>
    </html>
@endsection
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function() {
        //点击+
        $(document).on("click", ".add", function () {
            var _this = $(this);//当前点击的+
            var buy_number = parseInt(_this.prev("input").val());//购买数量
            var goods_num = parseInt(_this.parents('tr').attr("goods_num"));//库存
            var goods_id = _this.parents('tr').attr("goods_id");

            //给文本框的购买数量+1
            if (buy_number >= goods_num) {
                _this.prev("input").val(goods_num);//当购买数量>=库存时把在改为库存数量
            } else {
                buy_number += 1;
                _this.prev("input").val(buy_number);
            }
            //给数据库的购买数量+1
            var res = changeBuyNumber(goods_id, buy_number, _this);
            if (res == 2) {
                return false;
            }
            //给当前行上的复选框选中状态
            changeChecked(_this);

            //重新获取小计
            changecount(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getCount();
        });
        //点击-
        $(document).on("click", ".less", function () {
            var _this = $(this);//当前点击的-
            var buy_number = parseInt(_this.next("input").val());//购买数量
            var goods_id = _this.parents('tr').attr("goods_id");

            //给文本框的购买数量-1
            if (buy_number <= 1) {	//购买数量最小不能低于1
                _this.next("input").val(1);
            } else {
                buy_number = buy_number - 1;
                _this.next("input").val(buy_number);
            }
            //给数据库的购买数量-1
            var res = changeBuyNumber(goods_id, buy_number, _this);
            if (res == 2) {
                return false;
            }
            //给当前行上的复选框选中状态
            changeChecked(_this);

            //重新获取小计
            changecount(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getCount();
        });
        //失去焦点 验证
        $(document).on("blur", ".buy_number", function () {
            var _this = $(this);//当前失去焦点的文本框
            var buy_number = _this.val();
            var goods_num = parseInt(_this.parents("tr").attr("goods_num"));
            var goods_id = _this.parents("tr").attr("goods_id");

            //验证
            var reg = /^\d{1,}$/;
            if (!reg.test(buy_number) || parseInt(buy_number) <= 1) {
                _this.val(buy_number = 1);
            } else if (parseInt(buy_number) >= goods_num) {
                _this.val(goods_num);
            } else {
                _this.val(parseInt(buy_number));
            }
            //给数据库的购买数量 改为文本框的购买数量
            var res = changeBuyNumber(goods_id, buy_number, _this);
            if (res == 2) {
                return false;
            }
            //给当前行上的复选框选中状态
            changeChecked(_this);

            //重新获取小计
            changecount(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getCount();
        });
        //点击复选框
        $(document).on("click", ".box", function () {
            var _this = $(this);//当前点击的复选框
            var status = _this.prop("checked");
            var goods_id = _this.parents("tr").attr("goods_id");
            if (status == true) {
                //颜色变为灰色
                changeChecked(_this)
            } else {
                _this.parents("tr").removeClass('car_tr');
            }

            //重新获取小计
            changecount(goods_id,_this);
            //获取总价
            getCount();
        })
        //点击全选
        $(document).on("click", "#allbox", function () {
            var status = $("#allbox").prop("checked");
            if (status == true) {
                $("tr[goods_id]").addClass('car_tr');
            } else {
                $("tr[goods_id]").removeClass('car_tr');
            }
            $(".box").prop("checked", status);
            //获取总价
            getCount();
        })

        //修改购买数量
        function changeBuyNumber(goods_id, buy_number, _this) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var flag = 1;
            $.ajax({
                method: "POST",
                url: "{{url('/caret')}}",
                data: {goods_id: goods_id, buy_number: buy_number},
                async: false
            }).done(function (res) {
                //console.log(res);
                if (res == "no") {	//修改失败的值变为当前的 值
                    alert("修改失败");
                    _this.prev("input").val(goods_num - 1);
                    flag = 2;
                }
            });
            return flag;
        }

        //复选框选中状态
        function changeChecked(_this) {
            _this.parents("tr").find(".box").prop("checked", true);
        }
        //获取总价
        function getCount() {
            var goods_id = "";
            var _box = $(".box:checked");
            _box.each(function (index) {
                goods_id += $(this).parents("tr").attr('goods_id') + ',';
            });
            goods_id = goods_id.substr(0, goods_id.length - 1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                    "{{url('/getCount')}}",
                    {goods_id:goods_id},
                    function(res){
                        $("#money").text('￥'+res);
                    }
            );
        };
        //获取小计
        function changecount(goods_id,_this){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                    "{{url('/caretcount')}}",
                     {goods_id:goods_id},
                     function(res){
                         //console.log(res);
                        _this.parents("tr").find(".total").text(res);
                    }
            );
        }

        //确认账单
        $(document).on('click','.submit',function(){
            var _box=$('.box:checked');
            //console.log(_box);
            if(_box.length>0){
                var goods_id="";
                _box.each(function(index){
                    goods_id+=$(this).parents('tr').attr('goods_id')+',';
                });
                goods_id=goods_id.substr(0,goods_id.length-1);
                //console.log(goods_id);
                location.href='/pay/'+goods_id;
                //alert('添加购物车成功');location.href='/carlist';
            }else{
                alert('请至少选择一个商品进行结算');
            }
        })

        //点击删除
        $(document).on("click",".del",function(){
            if(window.confirm('是否确认删除')) {
                //获取选中的复选框所属于的商品id
                var _box = $(".box:checked");
                 var  goods_id = $(this).parents("tr").attr("goods_id") + ',';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(
                    "{{url('/cartDel')}}",
                    {goods_id: goods_id},
                    function (res) {
                        if (res == 'ok') {
                            alert('删除成功');
                            _box.parents("tr").remove();
                                //获取总价
                                getCount();
                        } else {
                            alert('删除失败');
                        }
                    }
                );
            }
        });


        //点击批量删除
        $(document).on("click","#delmany",function(){
            //获取选中的复选框所属于的商品id
            var _box=$(".box:checked");
            var goods_id="";
            _box.each(function(index){
                goods_id+=$(this).parents("tr").attr("goods_id")+',';
            });
            goods_id=goods_id.substr(0,goods_id.length-1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                    "{{url('/cartDel')}}",
                     {goods_id:goods_id},
                     function(res){
                        if(res=='ok'){
                            _box.each(function(index){
                                $(this).parents("tr").remove();
                                //将商品总价改为零
                                $("#money").text('￥0');
                            });
                        }
                    }
            );

        });

    });
</script>