<?php 

function getSonList($arr,$pid=0,$level=1){
	static $list=array();
	foreach ($arr as $k => $v) {
		if($v['parent_id']==$pid){
			$v['level']=$level;
			$list[]=$v;
			getSonList($arr,$v['node_id'],$level+1);

		}
	}
    return $list;
}


function getSonKey($data,$pid=0){
     $arr=array();
     foreach ($data as $key => $v) {
       if($v['parent_id']==$pid){
       	$v['son']=getSonKey($data,$v['node_id']);
       	$arr[]=$v;
       }
     }
     return $arr;
}


