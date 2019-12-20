@extends('layouts.shop')
@section('title', '确认结算')
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <div class="dingdanlist" onClick="window.location.href='address.html'">
        <table>
            <tr>
                <td class="dingimg" width="75%" colspan="2">新增收货地址</td>
                <td align="right"><a href="{{url('/add_address')}}"><img src="/static/index/images/jian-new.png" /></a></td>
            </tr>
            <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
            <tr>
                <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
                <td align="right"><img src="/static/index/images/jian-new.png" /></td>
            </tr>
            <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
            <tr>
                <td class="dingimg" width="75%" colspan="2">支付方式</td>
                <td align="right"><span class="hui">网上支付</span></td>
            </tr>
            <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">优惠券</td>--}}
                {{--<td align="right"><span class="hui">无</span></td>--}}
            {{--</tr>--}}
            {{--<tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>--}}
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">是否需要开发票</td>--}}
                {{--<td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">发票抬头</td>--}}
                {{--<td align="right"><span class="hui">个人</span></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">发票内容</td>--}}
                {{--<td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>--}}
            {{--</tr>--}}
            <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
            <tr>
                <td class="dingimg" width="75%" colspan="3">商品清单</td>
            </tr>
            @foreach($goodsInfo as $v)
                <tr goods_id="{{$v->goods_id}}" goods_num="{{$v->goods_num}}">
                    <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" /></td>
                    <td width="50%">
                        <h3>{{$v->goods_name}}</h3>
                        <time>下单时间：{{date('Y-m-d h:i:s',$v->add_time)}}</time>
                    </td>
                    <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
                </tr>
                <tr>
                    <th colspan="3"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>
                </tr>
            @endforeach
            <tr>
                <td class="dingimg" width="75%" colspan="2">商品金额</td>
                <td align="right"><strong class="orange">¥68.80</strong></td>
            </tr>
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">折扣优惠</td>--}}
                {{--<td align="right"><strong class="green">¥0.00</strong></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">抵扣金额</td>--}}
                {{--<td align="right"><strong class="green">¥0.00</strong></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td class="dingimg" width="75%" colspan="2">运费</td>--}}
                {{--<td align="right"><strong class="orange">¥20.80</strong></td>--}}
            {{--</tr>--}}
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange">¥69.88</strong></td>
                <td width="40%"><a href="{{url('/success')}}" class="jiesuan">提交订单</a></td>
            </tr>
        </table>
    </div><!--dingdanlist/-->


    </div><!--content/-->

    <div class="height1"></div>
    <div class="gwcpiao">
        <table>

        </table>
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

