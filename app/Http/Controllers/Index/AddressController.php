<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Area;


class AddressController extends Controller{
    public function address(){
        $where=[
            ['pid','=',0]
        ];
        $data=Area::where($where)->get();
        return view('index.address',['data'=>$data]);
    }



    //获取区域信息
    function getPlaceInfo($pid){
        $where=[
            ['pid','=',$pid]
        ];
        return Area::where($where)->get();
    }

    function getplace($id){
        if(!$id==0){
            $info=$this->getPlaceInfo($id);
            echo json_encode($info);
        }
    }

    //点击添加
    public function save(){
        $data=request()->input();

        //判断当前添加的数据 是否设置为默认
        if(!empty($data['is_default'])){
            //将数据库中当前用户所有人的is_default改为2
            $where=[
                ['is_del','=',1]
            ];
            $result=DB::table('address')->where($where)->update(['is_default'=>2]);
        }

        $res=$address_model->save($data);
        if($res){
            successly('添加成功');
        }else{
            fail('添加失败');
        }
    }
}
