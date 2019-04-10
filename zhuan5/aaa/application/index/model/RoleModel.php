<?php
	namespace app\index\model;
	use think\Model;
	class RoleModel extends Model{
		function addRole($roleName){
			//准备sql
			$sql="insert into role (roleName) values ('$roleName')";
			//执行sql
			return $this->execute($sql);
		}
		function getRoleList(){
			//准备sql
			$sql="select * from role";
			//执行sql
			return $this->query($sql);
		}
		function delRole($rid){
			//准备sql
			$sql="delete from role where id = {$rid}";
			//执行sql
			return $this->query($sql);
		}
		function getRoleInfo($rid){
			//准备sql
			$sql="select * from role where id = {$rid}";
			//执行sql
			return $this->query($sql);
		}
		function updateRole($rid,$roleName){
			//准备sql
			$sql="update role set roleName='$roleName' where id = {$rid}";
			//执行sql
			return $this->query($sql);
		}
		function getRoleIdsByUid($uid){
			//准备sql
			$sql="select roleId from userRole where userId = {$uid}";
			//执行sql
			$roleIds=$this->query($sql);
			$arr=array();
			if(!empty($roleIds)){
				foreach($roleIds as $item){
					$arr[]=$item['roleId'];
				}
			}
			return $arr;
		}
		public function addRoleNodes($roleId,$nodeIds){
			$sql="delete from roleNode where roleId={$roleId}";
			$this->query($sql);
			if(isset($nodeIds) && !empty($nodeIds)){
				foreach($nodeIds as $nodeId){
					$sql="insert into roleNode(roleId,nodeId) values('$roleId','$nodeId')";
					$this->execute($sql);
					$sql="select last_insert_id()";
					$id=$this->query($sql);
					if($id<0){
						return false;
					}
				}
			}
			return true;
		}
		public function getRoleCount(){
    		$sql="select count(*) as count from role";
	        return $this->query($sql);
    	}
	}