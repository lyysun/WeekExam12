<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class NodeModel extends Model
{
	function selects(){
		header('content-type:text/html;charset=utf-8');
			$sql="select * from node";
			$data=$this->query($sql);
			$res=array();
			foreach($data as $obj){
				if($obj['pid']==0){
					$res[$obj['id']]=$obj;
				}else{
					if(isset($res[$obj['pid']]) && $res[$obj['pid']]['id']==$obj['pid']){
						$res[$obj['pid']]['item'][]=$obj;
					}
				}
			}
			return $res;
	}

	function getNodeIdsByRoleId($roleId){
		$sql="select nodeId from rolenode where roleId ='$roleId'";
		$data=$this->query($sql);
		$arr=array();
		if(!empty($data)){
			foreach ($data as $node) {
				$arr[]=$node['nodeId'];
			}
		}
		return $arr;
	}
}