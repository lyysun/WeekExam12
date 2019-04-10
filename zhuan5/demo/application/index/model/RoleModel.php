<?php
	namespace app\index\model;
	use think\Model;
	class RoleModel extends Model
	{
		public function addRole($roleName){
			$createDateTime=date('Y-m-d H:i:s',time());
			$sql="insert into role(roleName,createDateTime) values('$roleName','$createDateTime')";
			$row=$this->execute($sql);
			$sql="select last_insert_id()";
			$id=$this->query($sql);
			return $id;
		}
		public function getRoleList(){
			$sql="select * from role";
			return $this->query($sql);
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
	}