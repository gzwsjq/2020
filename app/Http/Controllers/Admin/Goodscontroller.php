<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Goods;
use Validator;
use Illuminate\Validation\Rule;

class Goodscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *列表
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pagesize=config('app.pageSize');
        $data=Goods::paginate( $pagesize);
        foreach($data as $k=>$v){
            $data[$k]['goods_imgs']=explode('|',$v['goods_imgs']);
        }
        return view('Admin.goods.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *添加的视图
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //查询分类的数据 作为下拉菜单的值
         $cate=DB::table('category')->get();
        //查询品牌的数据作为下拉菜单的值
        $brand=DB::table('brand')->get();

        return view('Admin.goods.create',['cate'=>$cate,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *添加的执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $post=$request->except('_token');
        //dd($post);

        $validator = Validator::make($post, [
            'goods_name' => 'required|unique:goods|max:20|min:2',
            'goods_price' => 'required',
            'goods_num' => 'required',
            'goods_score' => 'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'商品名称已存在',
            'goods_name.max'=>'商品名称最大长度为20位',
            'goods_name.min'=>'商品名称最小的长度2位',
            'goods_price.required'=>'商品价格必填',
            'goods_num.required'=>'商品库存必填',
            'goods_score.required'=>'商品积分必填',

        ]);
        if ($validator->fails()) {
            return redirect('goods/create')
                ->withErrors($validator)
                ->withInput();
        }


        //文件上传
        if(request()->hasFile('goods_img')){
            $post['goods_img']=$this->upload('goods_img');
        }


        //多文件上传
        if(request()->hasFile('goods_imgs')){
            $imgs=$this->upload('goods_imgs');
            $post['goods_imgs']=implode('|',$imgs);
        }


        $res=DB::table('goods')->insert($post);
        if($res){
            return redirect('goods');
        }
    }

    /**
     * Display the specified resource.
     *展示列表
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑的视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($goods_id){
         $data=Goods::find($goods_id);

        //将多图分割
        $data['goods_imgs']=explode('|',$data['goods_imgs']);

        //查询分类的数据 作为下拉菜单的值
        $cate=DB::table('category')->get();
        //查询品牌的数据作为下拉菜单的值
        $brand=DB::table('brand')->get();

        return view('admin.goods.edit',['data'=>$data,'cate'=>$cate,'brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $goods_id){
        $post=request()->except('_token');

//        $validator = Validator::make($post, [
////            'goods_name' => 'required|unique:goods|max:20|min:2',
////            'goods_price' => 'required',
////            'goods_num' => 'required',
////            'goods_score' => 'required',
//            'goods_name' => [
//                'required',
//                Rule::unique('goods')->ignore($goods_id,'goods_id'),
//                'max:20',
//                'min:2'
//            ],
//            'goods_price' => 'required',
//            'goods_num' => 'required',
//            'goods_score' => 'required',
//
//        ],[
//            'goods_name.required'=>'商品名称必填',
//            'goods_name.unique'=>'商品名称已存在',
//            'goods_name.max'=>'商品名称最大长度为20位',
//            'goods_name.min'=>'商品名称最小的长度2位',
//            'goods_price.required'=>'商品价格必填',
//            'goods_num.required'=>'商品库存必填',
//            'goods_score.required'=>'商品积分必填',
//
//        ]);
//        if ($validator->fails()) {
//            return redirect('goods/create')
//                ->withErrors($validator)
//                ->withInput();
//        }

        //单文件上传
        if(request()->hasFile('goods_img')){
            $post['goods_img']=$this->upload('goods_img');
        }


        //多文件上传
        if(request()->hasFile('goods_imgs')){
            $imgs=$this->upload('goods_imgs');
            $post['goods_imgs']=implode('|',$imgs);
        }


        $res=Goods::where('goods_id',$goods_id)->update($post);
        return redirect('goods')->with('mo','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *执行删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($goods_id){
        $goods = Goods::find($goods_id);
        $goods->delete();
        echo "<script>alert('删除成功');location.href='/goods';</script>";
    }

    //文件上传
    public function upload($img){
        $imgs=request()->file($img);
        if(is_array($imgs)){
            $path=[];
          foreach($imgs as $v){
              if ($v->isValid()) {
                  $path[]=$v->store($img);
              }
          }
            return $path;
        }else{
            if ($imgs->isValid()) {
                //接收文件并上传
                $result=request()->file($img)->store($img);
                // 返回上传路径
                return $result;
            }
        }
        exit('未获取到上传文件或上传过程出错');
    }

    //即点即改
    public function changewin(Request $request){
        $value=$request->get('_value');
        $field=$request->get('field');
        $goods_id=$request->get('goods_id');
        $res=DB::table('goods')->where('goods_id',$goods_id)->update([$field=>$value]);
//        dd($value);
//        //$value=Goods::_value;
//        $value=input('post._value');
//        if($value=='√'){
//            $value1=2;
//        }else{
//            $value1=1;
//        }
//        $field=input('post._field');
//        $goods_id=input('post.goods_id');
//        $where=[
//            ['goods_id','=',$goods_id]
//        ];
//        $arr=[$field=>$value];
//        $res=DB::table('goods')->where($where)->update($arr);
//        if($res===false){
//            echo 2;
//        }else{
//            echo 1;
//        }

//        function  zt(req $req){
//            $fd=$req->get("fd");
//            $id=$req->get("id");
//            $new_val=$req->get("new_val");
//            $res= DB::table("ftyp")->where("id",$id)->update([$fd=>$new_val]);
//            return 1;
//        }
    }
}
