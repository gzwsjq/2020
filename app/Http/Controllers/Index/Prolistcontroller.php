<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\category;
use App\goods;

class Prolistcontroller extends Controller{
    public function prolist($cate_id){
        $cateinfo=Category::get();
        $cate_id=getcateid($cateinfo,$cate_id);
        $pagesize=config('app.pageSize');
        $goods=Goods::whereIn('cate_id',$cate_id)->paginate($pagesize);

        return view('index.prolist',['goods'=>$goods]);
    }




}
