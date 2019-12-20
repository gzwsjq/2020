@extends('layouts.shop')
@section('title', '商品详情')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        @foreach($goods->goods_imgs as $v);
        <img src="{{env('UPLOAD_URL')}}{{$v}}">
        @endforeach
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr>
            <th><strong class="orange">14.25</strong></th>
            <th>
                <input type="button" id="less" style="width:30px" value="—">
                <input type="text" value="1" style="width:30px;text-align:center" id="buy_number">
                <input type="button" id="add" style="width:30px" value="+">
            </th>
            </th>
            {{--<td>--}}
                {{--<input type="text" class="spinnerExample" />--}}
            {{--</td>--}}
        </tr>

        <tr>
            <td>
                <strong>{{$goods->goods_name}}</strong>
                <p class="hui">{{$goods->goods_desc}}</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品库存</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src="{{env('UPLOAD_URL')}}{{$goods->goods_img}}">
    </div><!--proinfoList/-->
    <div class="proinfoList">
        <b id="goods_num">{{$goods->goods_num}}</b>
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr>
            <th>
                <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a id="addcart">加入购物车</a></td>
        </tr>
    </table>
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
@endsection
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //点击+
        $(document).on("click","#add",function(){
            var goods_num=parseInt($("#goods_num").text());
            var buy_number=parseInt($("#buy_number").val());

            if(buy_number>=goods_num){
                $("#buy_number").val(goods_num);
            }else{
                buy_number+=1;
                $("#buy_number").val(buy_number);
            }
        });
        //点击-
        $(document).on("click","#less",function(){
            var buy_number=parseInt($("#buy_number").val());
            if(buy_number<=1){
                $("#buy_number").val(1);
            }else{
                buy_number-=1;
                $("#buy_number").val(buy_number);
            }
        });
        //失去焦点 验证
        $(document).on("blur","#buy_number",function(){
            var goods_num=parseInt($("#goods_num").text());
            var buy_number=$("#buy_number").val();

            var reg=/^\d{1,}$/;
            if(!reg.test(buy_number)||parseInt(buy_number)<=0){
                $("#buy_number").val(1);
            }else if(parseInt(buy_number)>=goods_num){
                $("#buy_number").val(goods_num);
            }else{

                $("#buy_number").val(parseInt(buy_number));
            }
        });
        //添加购物车
        $(document).on("click","#addcart",function(){
            var buy_number=$("#buy_number").val();
            var goods_id="{{$goods->goods_id}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "{{url('/addcart')}}",
                {buy_number:buy_number,goods_id:goods_id},
                function(res){
                    //console.log(res);
                    if(res=='ok'){
                        alert('加入购物车成功');
                        location.href='/car';
                    }
                }
            );
        });
    });
</script>