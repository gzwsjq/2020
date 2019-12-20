<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use DB;
use App\Model\caret;

class CarController extends Controller{
    //购物车列表表展示
    public function car(){
        $goods_id=Caret::get('goods_id');
        $where=[
            ['caret_del','=',1]
        ];
        $goodsInfo = Goods::leftjoin('caret','caret.goods_id','=','goods.goods_id')->whereIn('goods.goods_id',$goods_id)->where($where)->get();

        return view('index.car',['goodsInfo'=>$goodsInfo]);
    }
    //点击加载购物车
    public function addcart(){
        $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;

        $cart=Caret::where('goods_id','=',$goods_id)->first();
//    echo $cart['buy_number'];die;
        if($cart){
            $data = DB::table('caret')->where('goods_id','=',$goods_id)->update(['buy_number'=>$cart['buy_number']+$buy_number,'add_time'=>time()]);
        }else{
            $data = DB::table('caret')->insert(['goods_id'=>$goods_id,'buy_number'=>$buy_number,'add_time'=>time()]);
        }
        if($data){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    //修改购买数量
    public function caret(){
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        $where=[
            ['goods_id','=',$goods_id],
            ['caret_del','=',1]
        ];
        $result = caret::where($where)->update(['buy_number'=>$buy_number]);

        if($result!==false){
            echo "ok";
        }else{
            echo "no";
        }
    }
    //获取总价
    public function getCount(){
        $goods_id = request()->goods_id;
        $goods_id = explode(',',$goods_id);
        //根据商品id 查询单价数量
        $where=[
            ['goods.goods_id','in',$goods_id],
            ['caret_del','=',1],
        ];

        $info=Goods::leftjoin('caret','caret.goods_id','=','goods.goods_id')->whereIn('goods.goods_id',$goods_id)->get();
        //echo $info;
        $money=0;
        foreach($info as $k=>$v){
            $money+=$v['goods_price']*$v['buy_number'];
        }
        echo $money;
    }

    //获取小计
    public function caretcount(){
        $goods_id=request()->goods_id;
        //获取单价
        $goods_price=DB::table('goods')->where('goods_id','=',$goods_id)->value('goods_price');
        //获取数量
        $where=[
            ['goods_id','=',$goods_id],
            ['caret_del','=',1]
        ];
        $buy_number=DB::table('caret')->where($where)->value('buy_number');
        $tatle=$buy_number*$goods_price;
        echo $tatle;

    }

   //删除
    public function cartDel(){
        $goods_id = request()->goods_id;
        $goods_id=explode(',',$goods_id);
        $caret=caret::whereIn('goods_id',$goods_id)->update(['caret_del'=>2]);
        if($caret){
            echo "ok";
        }else{
            echo "no";
        }
    }



}
