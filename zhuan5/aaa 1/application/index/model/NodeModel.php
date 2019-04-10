<?php
	namespace app\index\model;
	use think\Model;
	class NodeModel extends Model{
		function getNodeList(){
			
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
		public function getNodeIdsByRoleId($roleId){
			$sql="select nodeId from rolenode where roleId='$roleId'";
			$data=$this->query($sql);

			$arr=array();
			if(!empty($data)){
				foreach($data as $node){
					$arr[]=$node['nodeId'];
				}
			}
			return $arr;
		}
		public function deleteNodeById($nodeId){
			$sql="delete from node where id='{$nodeId}'";
			return $this->query($sql);
		}
		public function addNode($nodeName,$nodeDes,$pid){
			$sql="insert into node(nodeName,nodeDes,pid) values('$nodeName','$nodeDes','$pid')";
			$row=$this->execute($sql);
			$sql="select last_insert_id()";
			$id=$this->query($sql);
			return $id;
		}
		public function updateNodeById($nodeId,$nodeDes){
			$sql="update node set nodeDes='$nodeDes' where id='$nodeId'";
			return $this->query($sql);
		}
		public function getNodeCount(){
    		$sql="select count(*) as count from node where pid!=0";
	        return $this->query($sql);
    	}
	}