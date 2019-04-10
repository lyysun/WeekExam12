<?php
namespace app\index\model;
use app\index\controller\Rbac;
use think\Controller;
use think\Model;
use think\Db;
class NodeModel extends Model
	{ 
        
		function selectnode(){
			$sql="select * from node";
			$data=$this->query($sql);
			$arr=array();
			if(isset($data) && !empty($data)){
				foreach ($data as $item) {
				if($item['pid']==0){
					$key=$item['id'];
					$arr[$key]=$item;
				}else{
					$key=$item['pid'];
					if (isset($arr[$key])) {
					  $arr[$key]['child'][]=$item;
					}
				}
				}
			}
			return $arr;
		}
	}