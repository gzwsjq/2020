<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Clogin;
use Validator;
use Illuminate\Validation\Rule;

class Clogincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *列表
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $data=DB::table('clogin')->get();
        return view('admin.clogin.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.clogin.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=request()->except('_token');

        $validator = Validator::make($post, [
            'account' => 'required|unique:clogin|max:20|min:2',
            'pwd' => 'required',
        ],[
            'account.required'=>'账号必填',
            'account.unique'=>'账号已存在',
            'account.max'=>'账号最大长度为20位',
            'account.min'=>'账号最小的长度2位',
            'pwd.required'=>'密码必填',

        ]);
        if ($validator->fails()) {
            return redirect('clogin/create')
                ->withErrors($validator)
                ->withInput();
        }


        //文件上传
        if(request()->hasFile('img')){
            $post['img']=$this->upload('img');
        }

        $res=DB::table('clogin')->insert($post);
        if($res){
            return redirect('clogin');
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
    public function edit($id){
      $data=DB::table('clogin')->where('id',$id)->first();
        return view('admin.clogin.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *编辑的执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $post=$request->except('_token');
        $res=DB::table('clogin')->where('id',$id)->update($post);

        $validator = Validator::make($post, [
            'account' => [
                'required',
                Rule::unique('clogin')->ignore($id,'id'),
                'max:12',
                'min:2'
            ],
            'pwd' => 'required',
        ],[
            'account.required'=>'账号必填',
            'account.unique'=>'账号已存在',
            'account.max'=>'账号最大长度为20位',
            'account.min'=>'账号最小的长度2位',
            'pwd.required'=>'密码必填',

        ]);
        if ($validator->fails()) {
            return redirect('clogin')
                ->withErrors($validator)
                ->withInput();
        }

        //文件上传
        if(request()->hasFile('img')){
            $post['img']=$this->upload('img');
        }

        //$res=Clogin::where('id',$id)->update($post);
        return redirect('clogin')->with('io','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $id=request()->id;
        $res=DB::table('clogin')->where('id',$id)->delete();
        echo "<script>alert('删除成功');location.href='/clogin';</script>";
    }

    public function upload($img){
        if (request()->file($img)->isValid()) {
            $photo = request()->file($img);
            $store_result = $photo->store($img);
            // $store_result = $photo->storeAs('photo', 'test.jpg');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
}
