<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::view('/hello','welcome',['welcome'=>'欢迎laravel']);

//Route::get('login','index\login@login');

//Route::post('logindo','index\login@logindo')->name('do');

//必选参数以及正则约束
/*Route::get('goods/{name}',function($name){
    echo $name;
})->where('name','[\x{4e00}-\x{9fa5}]+');*/

//可选参数
//Route::get('user/{id}/{name?}',function($id,$name='海绵宝宝'){
    //echo $id;
   // echo $name;
//});

//正则约束
//Route::get('good/{id}','index\test@good');
//Route::view('/login','login');
//Route::post('dologin','Admin\Logincontroller@dologin');
//路由分组
Route::prefix('brand')->group(function (){
    //品牌表的增删改查
    Route::get('/','Admin\Brandcontroller@index');//列表页面
    Route::get('create','Admin\Brandcontroller@create');//添加页面
    Route::post('store','Admin\Brandcontroller@store');//执行添加
    Route::get('delete/{id}','Admin\Brandcontroller@destroy');//执行删除
    Route::get('edit/{id}','Admin\Brandcontroller@edit');//编辑的页面
    Route::post('update/{id}','Admin\Brandcontroller@update');//执行编辑
    Route::post('checkajax','Admin\Brandcontroller@checkajax');
});

//设置cookie
//Route::get('addcookie', function () {
//    $res = response('欢迎来到 Laravel 学院')->cookie('name', '学院君', 1);
//    dump($res);
//    $arr= request()->cookie('name');
//    dd($arr);
//});

////设置cookie
Route::get('addcookie', function () {
    \Cookie::queue('name', 'ppp', 1);
    //return response('欢迎来到 Laravel 学院')->cookie('name', '学院君', 1);
});

//获取cookie
Route::get('getcookie', function () {
    //设置cookie
   // \Cookie::queue(\Cookie::make('oo', '123', 1));
      \Cookie::queue('kk', 'sqj', 1);
   //获取的两中方式
    //echo  request()->cookie('kk');
     echo   \Cookie::get('name');
});

//分类的增删改查
Route::prefix('category')->group(function () {
    Route::get('/','Admin\Categorycontroller@index');//列表页面
    Route::get('create','Admin\Categorycontroller@create');//添加页面
    Route::post('store','Admin\Categorycontroller@store');//执行添加
    Route::get('delete/{cate_id}','Admin\Categorycontroller@destroy');//执行删除
    Route::get('edit/{cate_id}','Admin\Categorycontroller@edit');//编辑的页面
    Route::post('update/{cate_id}','Admin\Categorycontroller@update');//执行编辑
    Route::post('changeName','Admin\Categorycontroller@changeName');//即点即改的操作
    Route::post('changewin','Admin\Categorycontroller@changewin');//是否显示的即点即改
});

//商品的增删改查
Route::prefix('goods')->group(function () {
    Route::get('/','Admin\Goodscontroller@index');//列表页面
    Route::get('create','Admin\Goodscontroller@create');//添加页面
    Route::post('store','Admin\Goodscontroller@store');//执行添加
    Route::get('delete/{goods_id}','Admin\Goodscontroller@destroy');//执行删除
    Route::get('edit/{goods_id}','Admin\Goodscontroller@edit');//编辑的页面
    Route::post('update/{goods_id}','Admin\Goodscontroller@update');//执行编辑
});


//管理的操作
Route::prefix('clogin')->group(function () {
    Route::get('/','Admin\Clogincontroller@index');//列表的页面
    Route::get('create','Admin\Clogincontroller@create');//添加页面
    Route::post('store','Admin\Clogincontroller@store');//执行添加
    Route::get('delete/{id}','Admin\Clogincontroller@destroy');//执行删除
    Route::get('edit/{id}','Admin\Clogincontroller@edit');//编辑的页面
    Route::post('update/{id}','Admin\Clogincontroller@update');//执行编辑
});


Route::view('/onelogin','onelogin');
Route::post('dlogin','Admin\Onelogincontroller@dlogin');
//周考的相关题目操作
Route::prefix('one')->middleware('checkOne')->group(function () {
    Route::get('/','Admin\Onecontroller@index');//列表的页面
    Route::get('create','Admin\Onecontroller@create');//添加的页面
    Route::post('store','Admin\Onecontroller@store');//执行添加
    Route::get('delete/{sid}','Admin\Onecontroller@destroy');//执行删除
    Route::get('edit/{sid}','Admin\Onecontroller@edit');//编辑的页面
    Route::post('update/{sid}','Admin\Onecontroller@update');//执行编辑
});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

//前台首页
Route::get('/','Index\IndexController@index');
Route::get('/login','Index\LoginController@login');//登录
Route::post('/dologin','Index\Logincontroller@dologin');//执行登录
Route::get('/outlogin','Index\Logincontroller@outlogin');//退出登录
Route::get('/reg','Index\RegController@reg');//注册
Route::post('/sendtel','Index\RegController@sendtel');//注册的过程
Route::post('/regdo','Index\RegController@regdo');//执行注册
Route::get('/test','Index\RegController@test');//测试
Route::get('/prolist/{cate_id}','Index\Prolistcontroller@prolist');//详情
Route::get('/car','Index\Carcontroller@car');//购物车
Route::post('/addcart','Index\Carcontroller@addcart');//点击加载购物车
Route::get('/catlist','Index\Carcontroller@catlist');//购物车列表
Route::post('/caret','Index\Carcontroller@caret');//
Route::post('/getCount','Index\Carcontroller@getCount');//获取总价
Route::post('/caretcount','Index\Carcontroller@caretcount');//获取小计

Route::post('/cartDel','Index\Carcontroller@cartDel');//点击删除

Route::get('/user','Index\Usercontroller@user');//我的
Route::get('/proinfo/{goods_id}','Index\Proinfocontroller@proinfo');//我的
Route::get('/pay/{goods_id}','Index\Paycontroller@pay');//确认结算
Route::get('/success','Index\Successcontroller@success');//确认结算
Route::get('/add_address','Index\Add_addresscontroller@add_address');//收货地址的展示
Route::post('/addressdel','Index\Add_addresscontroller@addressdel');//收货地址批量删除
Route::get('/address','Index\AddressController@address');//收货地址的添加
Route::post('/save','Index\AddressController@save');//收货地址的添加
Route::get('/getplace/{id}','Index\AddressController@getplace');//收货地址的添加
Route::get('/order','Index\ordercontroller@order');//收货地址





//发送邮件
Route::get('/send_email','MailController@send_email');


//发起手机支付
Route::get('/payss/{order_id}','Index\Membercontroller@payss');
Route::get('/return_url','Index\Membercontroller@return_url');
Route::post('/notify_url','Index\Membercontroller@notify_url');


