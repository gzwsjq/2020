<?php
  //后台公共函数
function show(){
    echo 123;
}

//递归
//function getCateInfo($cateInfo,$parent_id=0,$level=0){
//    static $info=[];
//    foreach($cateInfo as $k=>$v){
//        if($v['parent_id']==$parent_id){
//            $v['level']=$level;
//            $info[]=$v;
//            getCateInfo($cateInfo,$v['cate_id'],$v['level']+1);
//        }
//    }
//    return $info;
//}

//function getinfo($cateinfo,$parent_id=0){
//    $info=[];
//    foreach($cateinfo as $k=>$v){
//        if($v['parent_id']==$parent_id){
//            $son=getinfo($cateinfo,$v['cate_id']);
//            $v['son']=$son;
//            $info[]=$v;
//        }
//    }
//    return $info;
//}

function getcateid($cateinfo,$parent_id){
    static $c_id=[];
    $c_id[$parent_id]=$parent_id;
    foreach($cateinfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $c_id[$v['cate_id']]=$v['cate_id'];
            getcateid($cateinfo,$v['cate_id']);
        }
    }
    return $c_id;
}


//public function getuserid(){
//    return session('user.user_id');
//}





?>