<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Category;
use Illuminate\Validation\Rule;


class Categorycontroller extends Controller{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $cateInfo=Category::get();
        $data =getCateInfo($cateInfo);
        return view('Admin.category.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *添加的页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询分类的数据 作为下拉菜单的值
        $data=Category::get();
        $cateinfo =getCateInfo($data);

        return view('admin.category.create',['cateinfo'=>$cateinfo]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $post=$request->except('_token');
        //dd($post);

        $validator = Validator::make($post, [
            'cate_name' => 'required|unique:category|max:20|min:2',
        ],[
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称已存在',
            'cate_name.max'=>'分类名称最大长度为20位',
            'cate_name.min'=>'分类名称最小的长度2位',

        ]);
        if ($validator->fails()) {
            return redirect('category/create')
                ->withErrors($validator)
                ->withInput();
        }

        $res=DB::table('category')->insert($post);
        if($res){
            return redirect('category');
        }
    }

    /**
     * Display the specified resource.
     *展示详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑的页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cate_id)
    {
       $data=Category::find($cate_id);

        //查询分类的数据 作为下拉菜单的值
        $cateinfo=DB::table('category')->get();

        return view('admin.category.edit',['data'=>$data,'cateinfo'=>$cateinfo]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cate_id)
    {
        $post=request()->except('_token');

        $validator = Validator::make($post, [
            // 'bname' => 'required|unique:brand|max:20|min:2',
            'cate_name' => [
                'required',
                Rule::unique('category')->ignore($cate_id,'cate_id'),
                'max:12',
                'min:2'
            ],
        ],[
            'cate_name.required'=>'品牌名称必填',
            'cate_name.unique'=>'品牌名称已存在',
            'cate_name.max'=>'品牌名称最大长度为20位',
            'cate_name.min'=>'品牌名称最小的长度2位',
        ]);
        if ($validator->fails()) {
            return redirect('category')
                ->withErrors($validator)
                ->withInput();
        }

        $res=Category::where('cate_id',$cate_id)->update($post);
        return redirect('category')->with('mg','修改成功');


    }

    /**
     * Remove the specified resource from storage.
     *执行删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cate_id){
        $Category = Category::find($cate_id);
        $Category->delete();
        echo "<script>alert('删除成功');location.href='/category';</script>";
    }


    public function changeName(){
        $value=request()->value;
        $field=request()->field;
        $cate_id=request()->cate_id;

        $where=[];
        if($value){
            $where['value']=$value;
        }

        if($field){
            $where['field']=$field;
        }

        if($cate_id){
            $where['cate_id']=$cate_id;
        }

        $arr=[$field=>$value];
        $res=DB::table('category')->where('cate_id',$cate_id)->update($arr);

        if($res===false){
            echo 'no';
        }else{
            echo 'ok';
        }

    }

    public  function changewin(){
        $value=request()->_value;
        if($value=='√'){
            $value1=2;
        }else{
            $value1=1;
        }
        $field=request()->_field;
        $cate_id=request()->cate_id;

        $where=[];
        if($value){
            $where['value']=$value;
        }

        if($field){
            $where['field']=$field;
        }

        if($cate_id){
            $where['cate_id']=$cate_id;
        }

        $arr=[$field=>$value1];
        $res=DB::table('category')->where('cate_id',$cate_id)->update($arr);
        if($res===false){
            echo 2;
        }else{
            echo 1;
        }
    }


}
