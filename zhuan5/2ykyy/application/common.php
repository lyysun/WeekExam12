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
           nodedg($arr,$v['id'],$level+1);
		}
	}
	return $list;
}
