@extends('layouts.shop')
@section('title', '商品详情')
@section('content')
 <header>
  <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
  <div class="head-mid">
   <form action="#" method="get" class="prosearch"><input type="text" /></form>
  </div>
 </header>
 <ul class="pro-select">
  <li class="pro-selCur"><a href="javascript:;">新品</a></li>
  <li><a href="javascript:;">销量</a></li>
  <li><a href="javascript:;">价格</a></li>
 </ul><!--pro-select/-->
 <div class="prolist">
  @foreach($goods as $v)
   <dl>
    <dt><a href="{{url('/proinfo')}}"> <img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="100px" height="50px"></a></dt>
    <dd>
     <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
     <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></div>
     <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
    </dd>
    <div class="clearfix"></div>
   </dl>
  @endforeach
   {{$goods->links()}}

@endsection
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
 $(function(){
  $(document).on("click",".pro-select>li",function(){
   $(this).addClass("pro-selCur").siblings("li").removeClass("pro-selCur");
  });
 });
</script>

