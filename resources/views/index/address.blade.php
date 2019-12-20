@extends('layouts.shop')
@section('title', '收货地址的添加')
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
     <form id="myform" method="get" class="reg-login">
         @csrf
         <div class="lrBox">
             <div class="lrList"><input type="text" name="man" placeholder="收货人" /></div>
             <div class="lrList"><input type="text" name="detail_address" placeholder="详细地址" /></div>

             <select class="change">
                 <option>省份/直辖市</option>
                 @foreach($data as $v)
                     <option value="{{$v->id}}">{{$v->name}}</option>
                 @endforeach
             </select>

             <select class="change">
                 <option value="0" selected="selected">市/县级市</option>
             </select>

             <select class="change">
                 <option value="0" selected="selected">县/区</option>
             </select>

             <div class="lrList"><input type="text" name="tel" placeholder="手机" /></div>
             <div class="lrList2"><input type="checkedbox" name="is_default" placeholder="设为默认地址" /> <button>设为默认</button></div>
         </div><!--lrBox/-->
         <div class="lrSub">
             <input type="submit" class="add_b" value="保存" />
         </div>
     </form><!--reg-login/-->
@endsection
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //下拉菜单的选取
        $(document).on('change','.change',function(){
            var _this=$(this);  //表示当前要发生内容改变的下拉菜单
            _this.nextAll('select').html("<option value=''>--请选择--</option>");
            var id=_this.val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{url('/getplace')}}/"+id,
                dataType:'json',
            }).done(function(res){
                //console.log(res);
                var _option="<option value=''>--请选择--</option>";
                for(var i in res){
                    _option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>"
                }
                //console.log(_option);
                _this.next('select').html(_option);
            })
        })

        //点击添加
        $(document).on("click",".add_b",function(){
            //获取表单所有的值
            var data=$("#myform").serialize(); //字符串格式 名=值&&名=值
            var return_url="{{$Think.get.return_url}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                    "{{url('/save')}}}",
                     data,
                     function(res){
                         console.log(res);
//                        alert(res.font);
//                        if(res.code==1){
//                            if(return_url==''){
//                                location.href="{:url('address/index')}";
//                            }else{
//                                location.href='/index.php/'+return_url;
//                            }
//                        }
                    }
            );
        });
    })
</script>
