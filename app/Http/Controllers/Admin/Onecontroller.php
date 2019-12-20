<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class Onecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *列表
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pagesize=config('app.pageSize');
        $stitle=request()->stitle;
        $id=request()->id;

        $where=[];
        if($stitle){
            $where[]=['stitle','like',"%$stitle%"];
        }

        if($id){
            $where[]=['id','like',"%$id%"];
        }
        $tail=DB::table('tail')->get();
        $data=DB::table('one')->where($where)->leftJoin('tail','one.id','=','tail.id')->orderBy('sid','desc')->paginate( $pagesize);
        $query=request()->all();
        return view('admin.one.index',['data'=>$data,'query'=>$query,'tail'=>$tail]);
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //查询下拉菜单的值
        $tail=DB::table('tail')->get();
        return view('admin.one.create',['tail'=>$tail]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $post=$request->except('_token');
        $post['stime']=time();
        //dd($post);

        $validator = Validator::make($post, [
            'stitle' => 'required|unique:one|max:20|min:2',
            'id' => 'required',
            'scom' => 'required',
            'sshow' => 'required',
        ],[
            'stitle.required'=>'文章标题必填',
            'stitle.unique'=>'文章标题已存在',
            'stitle.max'=>'文章标题最大长度为20位',
            'stitle.min'=>'文章标题最小的长度2位',
            'id.required'=>'文章分类必填',
            'scom.required'=>'文章重要性必填',
            'sshow.required'=>'是否显示必填',


        ]);
        if ($validator->fails()) {
            return redirect('one/create')
                ->withErrors($validator)
                ->withInput();
        }

        //文件上传
        if(request()->hasFile('slogo')){
            $post['slogo']=$this->upload('slogo');
        }

        $res=DB::table('one')->insert($post);
        if($res){
            return redirect('one');
        }
    }

    /**
     * Display the specified resource.
     *列表展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sid){
        $data=DB::table('one')->where('sid',$sid)->first();

        //查询下拉菜单的值
        $tail=DB::table('tail')->get();
        return view('admin.one.edit',['data'=>$data,'tail'=>$tail]);
    }

    /**
     * Update the specified resource in storage.
     *编辑的执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sid)
    {
        $post=request()->except('_token');

        $validator = Validator::make($post, [
           // 'stitle' => 'required|unique:one|max:20|min:2',
            'stitle' => [
                'required',
                Rule::unique('one')->ignore($sid,'sid'),
                'max:12',
                'min:2'
            ],
            'id' => 'required',
            'scom' => 'required',
            'sshow' => 'required',
        ],[
            'stitle.required'=>'文章标题必填',
            'stitle.unique'=>'文章标题已存在',
            'stitle.max'=>'文章标题最大长度为20位',
            'stitle.min'=>'文章标题最小的长度2位',
            'id.required'=>'文章分类必填',
            'scom.required'=>'文章重要性必填',
            'sshow.required'=>'是否显示必填',


        ]);
        if ($validator->fails()) {
            return redirect('one/create')
                ->withErrors($validator)
                ->withInput();
        }


        //单文件上传
        if(request()->hasFile('slogo')){
            $post['slogo']=$this->upload('slogo');
        }
       $res=DB::table('one')->where('sid',$sid)->update($post);
        return redirect('one')->with('mo','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *删除执行
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sid){
        $one = DB::table('one')->where('sid',$sid)->delete();

        echo "<script>alert('删除成功');location.href='/one';</script>";

//        $sid=request()->sid;
//        $res=DB::table('one')->where('sid',$sid)->delete();
//        echo "<script>alert('删除成功');location.href='/one';</script>";

    }

    //文件上传
    public function upload($img){
            if (request()->file($img)->isValid()) {
                //接收文件并上传
                $result=request()->file($img)->store($img);
                // 返回上传路径
                return $result;
            }
        exit('未获取到上传文件或上传过程出错');
    }


}
