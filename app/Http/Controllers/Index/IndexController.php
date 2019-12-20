<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IndexController extends Controller{
    public function index(){
        $goods_name=request()->goods_name;
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }

        $pagesize=config('app.pageSize');
        $goods=DB::table('goods')->where($where)->orderBy('goods_id','asc')->paginate($pagesize);
        $query=request()->all();

        $goodsinfo=DB::table('goods')->where('is_new','=',1)->limit(3)->get();
        $cate=DB::table('category')->where('parent_id','=',0)->get();
        return view('index.index',['goods'=>$goods,'cate'=>$cate,'query'=>$query,'goodsinfo'=>$goodsinfo]);
    }

}
