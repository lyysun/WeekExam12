<?php
namespace app\index\model;
use think\Model;
class NodeModel extends Model
{    
	function select(){
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
					if(isset($arr[$key]){
						$arr[$key]['child'][]=$item;
					}

				}
			}
			return $arr;
		}
	}
	
}