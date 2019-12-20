<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\goods;

class ProinfoController extends Controller{
    public function proinfo($goods_id){
        $where=[
            ['goods_id','=',$goods_id]
        ];
       $goods=Goods::where($where)->first();

        $goods['goods_imgs']=explode('|',$goods['goods_imgs']);
        //dd($goods);
        return view('index.proinfo',['goods'=>$goods]);
    }
}
