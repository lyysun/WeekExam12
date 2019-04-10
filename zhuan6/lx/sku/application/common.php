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

/**
 * 三级分类-找到孩子装进父亲son下标
 * @author Rong
 * @param  [type]  $data     [description]
 * @param  integer $parentId [description]
 * @return [type]            [description]
 */
function getThree($data,$parentId = 0){
  $arr = [];
  foreach ($data as $key => $val) {
    //找孩子
    if($val['parent_id']==$parentId){

        
        $val['son'] = getThree($data,$val['cat_id']);
        $arr[]= $val;
    }
  }
  return $arr;
}

/**
 * 找孩子
 * @author Rong
 * @param  [type]  $data    [description]
 * @param  integer $parenId [description]
 * @return [type]           [description]
 */
function getSon($data,$parentId = 0){
  static $arr = [];
  foreach ($data as $key => $val) {
    if($val['parent_id']==$parentId){
        $arr[] = $val;
        getSon($data,$val['cat_id']);
    }
  }
  return $arr;
}