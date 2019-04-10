<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function nodedg($arr,$pid=0,$level=1){
	static $list=array();
	foreach ($arr as $k => $v) {
		if($v['pid']==$pid){
           $v['level']=$level;
           $list[]=$v;
           nodedg($arr,$v['brand_id'],$level+1);
		}
	}
	return $list;
}

function getThree($data,$parentId=0){
	$arr=[];
	foreach ($data as $key => $va) {
		if($va['parent_id']==$parentId){
			$va['son']=getThree($data,$va['cat_id']);
			$arr[]=$va;
		}
	}
	return $arr;
}


function getSon($data,$parentId=0){
	static $arr=[];
	foreach ($data as $key => $val) {
		if($val['parent_id']==$parentId){
			$arr[]=$val;
			getSon($data,$val['cat_id']);
		}
	}
	return $arr;
}
