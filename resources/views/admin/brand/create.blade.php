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
<h3>品牌添加</h3><a href="{{url('brand')}}">列表</a><hr/>
    {{--@if ($errors->any())--}}
        {{--<div class="alert alert-danger">--}}
            {{--<ul>--}}
                {{--@foreach ($errors->all() as $error)--}}
                    {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--@endif--}}
<form class="form-horizontal" role="form" method="post" action="{{url('brand/store')}}" enctype="multipart/form-data" id="myform">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control bname" name="bname" id="firstname"
                   placeholder="请输入品牌名称">
            <b style="color:red">{{$errors->first('bname')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌logo</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="blogo" id="lastname"
                   placeholder="请输入品牌logo">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control cent" name="burl" id="lastname"
                   placeholder="请输入品牌网址">
            <b style="color:red">{{$errors->first('burl')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea placeholder="请输入品牌描述" class="form-control area"  name="bdesc" id="lastname"></textarea>
            <b style="color:red">{{$errors->first('bdesc')}}</b>
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
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        //品牌名称
        $(document).on('blur','#firstname',function(){
             var bnamecheck=checkName();
//            var _this=$(this);
//            $(this).next().text('');
//            var bname=$("#firstname").val();
//            var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;
//            if(!reg.test(bname)){
//                $(this).next().text('品牌名称由数字字母下划线中文组成，长度为2-12位');
//            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //唯一性验证
            $.ajax({
                method: "POST",
                url: "/brand/checkajax",
                data: { bname: bname }
            }).done(function( msg ) {
                if(msg>0){
                    $('#firstname').next().text('品牌已存在');
                }
            });

        });
        //品牌网址
        $(document).on("blur",".cent",function(){
            var _this=$(this);
            $(this).next().text('');
            var cent=$(".cent").val();
            var reg1=/^http:\/\//;
            if(!reg1.test(cent)){
                $(this).next().text('网址由http:://开头');
            }
        });
        //品牌描述
        $(document).on('blur','.area',function(){
            var _this=$(this);
            $(this).next().text('');
            var area=$(".area").val();
            if(area==''){
                $(this).next().text('品牌描述不能为空');
            }
        });
        //表单提交方式的 验证
//     $(document).on("submit","#myform",function(){
//         var bname=$('.bname').val();
//         var burl=$('.cent').val();
//         var reg=/^[\u4e00-\u9fa5\w]{2,12}$/;
//            if(!reg.test(bname)){
//                alert('品牌名称由数字字母下划线中文组成，长度为2-12位');
//                return false;
//             }
//         if(bname==''){
//             alert('品牌名称不能为空');
//             return false;
//         }
//
//         $.ajaxSetup({
//                headers: {
//                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                }
//            });
//            //唯一性验证
//            $.ajax({
//                method: "POST",
//                url: "/brand/checkajax",
//                data: { bname: bname }
//            }).done(function( msg ) {
//                if(msg>0){
//                    alert('品牌已存在');
//                }
//            });
//
//
//         if(burl==''){
//             alert('品牌网址不能为空');
//             return;
//         }
//      });

        function checkName(){
        $('#firstname').next().text('');
        var bname = $('#firstname').val();
        var reg = /^[\u4e00-\u9fa5\w]{2,12}$/;
        if(!reg.test(bname)){
        $('#firstname').next().text('品牌名称需是中文数字字母下划线组成长度为2-12位');
        return false;
        }
        return checkOnly(bname);
        }
    });
</script>



{{--<script>--}}
{{--$('#firstname').blur(function(){--}}
{{--checkName();--}}
{{--});--}}

{{--$('input[name="brand_url"]').blur(function(){--}}
{{--checkUrl();--}}
{{--});--}}

{{--$('.btn-default').click(function(){--}}
{{--//品牌名称--}}
{{--var NameFlag = checkName();--}}

{{--//品牌网址--}}
{{--var UrlFlag = checkUrl();--}}

{{--//提交--}}
{{--if( NameFlag && UrlFlag ){--}}
{{--// alert(123);--}}
{{--$('.form-horizontal').submit();--}}
{{--}--}}
{{--//return false;--}}
{{--});--}}
{{--function checkUrl(){--}}
{{--$('input[name="brand_url"]').next().text('');--}}
{{--var brand_url = $('input[name="brand_url"]').val();--}}
{{--var reg = /^http:\/\/+/;--}}

{{--if(!reg.test(brand_url)){--}}
{{--$('input[name="brand_url"]').next().text('品牌网址为http://开头');--}}
{{--return false;--}}
{{--}--}}
{{--return true;--}}
{{--}--}}

{{--function checkName(){--}}
{{--$('#firstname').next().text('');--}}
{{--var brand_name = $('#firstname').val();--}}
{{--var reg = /^[\u4e00-\u9fa5\w]{2,12}$/;--}}
{{--if(!reg.test(brand_name)){--}}
{{--$('#firstname').next().text('品牌名称需是中文数字字母下划线组成长度为2-12位');--}}
{{--return false;--}}
{{--}--}}
{{--return checkOnly(brand_name);--}}
{{--}--}}

{{--function checkOnly(brand_name){--}}
{{--$.ajaxSetup({--}}
{{--headers: {--}}
{{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--}--}}
{{--});--}}
{{--var flag = true;--}}
{{--//唯一性验证--}}
{{--$.ajax({--}}
{{--method: "POST",--}}
{{--url: "/brand/checkonly",--}}
{{--async:false,--}}
{{--data: { brand_name: brand_name }--}}
{{--}).done(function( msg ) {--}}
{{--if(msg>0){--}}
{{--$('#firstname').next().text('品牌名称已存在');--}}
{{--flag = false;--}}
{{--}--}}
{{--});--}}
{{--return flag;--}}
{{--}--}}

{{--</script>--}}