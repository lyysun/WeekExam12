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

function node($arr,$pid=0,$level=1){
      static $list=array();//定义一个数组
      foreach ($arr as $k => $v) {//循环遍历
      	if($v['pid']==$pid){//if判断pid等于0
      		$v['level']=$level;
      		$list[]=$v;
      		node($arr,$v['id'],$level+1);//从新调用自身
      	}
      }
       return $list;
}
