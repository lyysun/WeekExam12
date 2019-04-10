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
function nodedg($arr,$parent_id=0,$level=1){
	static $list=array();
	foreach ($arr as $k => $v) {
		if($v['parent_id']==$parent_id){
           $v['level']=$level;
           $list[]=$v;
           nodedg($arr,$v['cat_id'],$level+1);
		}
	}
	return $list;
}
