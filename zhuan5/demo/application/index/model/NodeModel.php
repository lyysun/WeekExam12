<?php
	namespace app\index\model;
	use think\Model;

	class NodeModel extends Model
	{
		public function addNode($nodeName,$nodeDes,$pid){
			$sql="insert into node(nodeName,nodeDes,pid) values('$nodeName','$nodeDes','$pid')";
			$row=$this->execute($sql);
			$sql="select last_insert_id()";
			$id=$this->query($sql);
			return $id;
		}
		public function getNodeList(){
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
		public function deleteUserByRoleId($roleId){
			$sql="delete from role where id = {$roleId}";
			return $this->query($sql);
		}
		public function getRoleInfoByRoleId($roleId){
			$sql="select * from role where id={$roleId}";
			return $this->query($sql);
		}
		public function updateRoleNameByRoleId($roleId,$roleName){
			$sql="update role set roleName = '$roleName' where id={$roleId}";
			return $this->query($sql);
		}
	}