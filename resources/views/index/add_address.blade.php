@extends('layouts.shop')
@section('title', '收货地址')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>收货地址</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><a href="{{url('/address')}}" class="hui"><strong class="">+</strong> 新增收货地址</a></td>
            <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;"><a href="javascript:;" class="orange" id="delMany">删除信息</a></td>
        </tr>
    </table>

    <div class="dingdanlist">
        <table>
            @foreach($data as $v)
                <tr address_id="{{$v->address_id}}">
                    <td width="3px"><input type="checkbox" class="box"/></td>
                    <td width="30%">
                        <h3>{{$v->man}}  {{$v->tel}}</h3>
                        <time>{{$v->detail_address}}</time>
                    </td>
                    <td align="right"><a href="address.html" class="hui"><span class="glyphicon glyphicon-check"></span> 修改信息</a></td>
                </tr>
            @endforeach
        </table>
    </div><!--dingdanlist/-->
@endsection
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //批量删除
        $(document).on("click","#delMany",function(){
            if(window.confirm('是否确认删除')) {
                //获取选中的复选框 所属的商品id
                var _box = $(".box:checked");
                var address_id = "";
                _box.each(function (index) {
                    address_id += $(this).parents("tr").attr("address_id")+',';
                });
                address_id = address_id.substr(0,address_id.length-1);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(
                        "{{url('/addressdel')}}",
                        {address_id: address_id},
                        function (res) {
                            //console.log(res);
                            if (res == 'ok') {
                                _box.each(function (index) {
                                    $(this).parents("tr").remove();
                                });
                            } else {
                                alert(res.font);
                            }
                        }
                );
            }
        })
    })
</script>
