<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

class PayController extends Controller{
    //确认结算
    public function pay($goods_id){
        $goods_id = explode(',',$goods_id);
        $goodsInfo = Goods::leftjoin('caret','caret.goods_id','=','goods.goods_id')
            ->whereIn('goods.goods_id',$goods_id)
            ->get();
        //dd($goodsInfo);
        return view('index.pay',['goodsInfo'=>$goodsInfo]);
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


}
