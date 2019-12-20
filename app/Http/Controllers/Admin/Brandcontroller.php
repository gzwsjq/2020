<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class Brandcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //show();
        //$data=DB::table('brand')->get();

        //session使用
        // session(['name' => '海绵宝宝']);//存
//          $a=session('name');//取
//          dump($a);
//        request()->session()->save();//存储服务器
//        $c=session(['name'=>null]);//删除
         // request()->session()->save();//存储服务器
//        dd($c);

         //request 实例
//        request()->session()->put('age','20');//存
//        request()->session()->save();//存储服务器
//        $aee=request()->session()->get('age');//取
//        dump($aee);
//        request()->session()->save();//存储服务器
//        $aee=request()->session()->pull('age');//先获取后删除
//        dump($aee);

//        $aee=request()->session()->forget('age');//删除单个
//        $aee=request()->session()->get('age');//取
//        dd($aee);

//        $arr=request()->session()->flush(); //全删
//        dd($arr);



        //搜索
        $bname=request()->bname;
        $burl=request()->burl;

        $where=[];
        if($bname){
            $where[]=['bname','like',"%$bname%"];
        }

        if($burl){
            $where[]=['burl','like',"%$burl%"];
        }

        $page=request()->page;
        //$data=Cache::get('data_'.$page.'_'.$bname.'_'.$burl);
        //echo 'data_'.$page.'_'.$bname.'_'.$burl;
       //Redis::del('data_'.$page.'_'.$bname.'_'.$burl);
        $data=Redis::get('data_'.$page.'_'.$bname.'_'.$burl);
        $data=unserialize($data);
        echo 'data_'.$page.'_'.$bname.'_'.$burl;
        //dump($data);die;
        if(!$data){

            echo '走数据库';
            $pagesize=config('app.pageSize');
            //监听SQL
            //DB::connection()->enableQueryLog();
            $data = DB::table('brand')->where($where)->orderBy('bid','desc')->paginate($pagesize);
                //Cache::put(['data_'.$page.'_'.$bname.'_'.$burl=>$data],20);
            Redis::set('data_'.$page.'_'.$bname.'_'.$burl,serialize($data));

        }

        //$logs = DB::getQueryLog();
        //dump($logs);
        $query=request()->all();
        return view('admin.brand.index',['data'=>$data,'query'=>$query]);


    }

    /**
     * Show the form for creating a new resource.
     *添加的页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
   // public function store(StoreBrandPost $request){
//             $request->validate([
//            'bname' => 'required|unique:brand|max:20|min:2',
//            'burl' => 'required',
//        ],[
//                 'bname.required'=>'品牌名称必填',
//                 'bname.unique'=>'品牌名称已存在',
//                 'bname.max'=>'品牌名称最大长度为20位',
//                 'bname.min'=>'品牌名称最小的长度2位',
//                 'burl.required'=>'品牌网址必填',
//
//             ]);
        //接收所有的值
        $post=$request->except('_token');

        $validator = Validator::make($post, [
            'bname' => 'required|unique:brand|max:20|min:2',
            'burl' => 'required',
        ],[
                 'bname.required'=>'品牌名称必填',
                 'bname.unique'=>'品牌名称已存在',
                 'bname.max'=>'品牌名称最大长度为20位',
                 'bname.min'=>'品牌名称最小的长度2位',
                 'burl.required'=>'品牌网址必填',

             ]);
        if ($validator->fails()) {
            return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
        }


        //dump($post);
        //$res=DB::table('brand')->insert($post);
        //dd(request()->hasFile('blogo'));
        //文件上传
        if(request()->hasFile('blogo')){
            $post['blogo']=$this->upload('blogo');
        }


        //ORM
          //$res= Brand::create($post);  //方法1
        $brand= new Brand;
        $brand->bname = $post['bname'];
        $brand->blogo = $post['blogo']??'';
        $brand->burl = $post['burl'];
        $brand->bdesc = $post['bdesc'];
        $res=$brand->save();    //方法二
         //$res=Brand::insert($post);
        if($res){
            return redirect('brand');
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
    public function edit($id){
        $data=Brand::find($id);
        //$data=DB::table('brand')->where('bid',$id)->first();
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         $post=$request->except('_token');
        //$res=DB::table('brand')->where('bid',$id)->update($post);

        $validator = Validator::make($post, [
           // 'bname' => 'required|unique:brand|max:20|min:2',
            'bname' => [
                'required',
                Rule::unique('brand')->ignore($id,'bid'),
                'max:12',
                'min:2'
            ],
            'burl' => 'required',
        ],[
            'bname.required'=>'品牌名称必填',
            'bname.unique'=>'品牌名称已存在',
            'bname.max'=>'品牌名称最大长度为20位',
            'bname.min'=>'品牌名称最小的长度2位',
            'burl.required'=>'品牌网址必填',

        ]);
        if ($validator->fails()) {
            return redirect('brand')
                ->withErrors($validator)
                ->withInput();
        }

        //文件上传
        if(request()->hasFile('blogo')){
            $post['blogo']=$this->upload('blogo');
        }

        $res=Brand::where('bid',$id)->update($post);
        return redirect('brand')->with('nbg','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       //$res=DB::table('brand')->where('bid',$id)->delete();
        //echo "<script>alert('删除成功');location.href='/brand';</script>";
       // return redirect('brand')->with('msg','删除成功');
        $brand = Brand::find($id);
        $brand->delete();
        echo "<script>alert('删除成功');location.href='/brand';</script>";

    }

    //文件上传
    public function upload($img){
        if (request()->file($img)->isValid()) {
            $photo = request()->file($img);
            $store_result = $photo->store($img);
           // $store_result = $photo->storeAs('photo', 'test.jpg');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    //ajax验证唯一性
    public function checkajax(){
        $bname=request()->bname;
        $where=[];
        if($bname){
            $where['bname']=$bname;
        }
        $count=DB::table('brand')->where($where)->count();
        echo $count;
    }
}
