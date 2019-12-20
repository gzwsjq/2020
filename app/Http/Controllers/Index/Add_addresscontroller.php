<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Address;


class Add_addresscontroller extends Controller{
    //收货地址的展示
    function add_address(){
        $data=Address::where('is_del','=',1)->get();
        return view('index.add_address',['data'=>$data]);
    }
    //收货地址的批量删除
    public function addressdel(){
        $address_id = request()->address_id;
        $address_id = explode(',',$address_id);
        $res = Address::whereIn('address_id',$address_id)->update(['is_del'=>2]);
        if($res){
            echo 'ok';
        }else{
            echo 'no';
        }
    }



}
