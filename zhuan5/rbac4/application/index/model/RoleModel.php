<?php
namespace app\index\model;
use app\index\controller\Rbac;
use think\Controller;
use think\Model;
use think\Db;
class RoleModel extends Model
	{ 
		function selects(){
			$sql="select * from role";
			// echo $sql;die;
			return $this->query($sql);
		}
		function RoleUserId($userId){
			$sql="select roleId from userrole where userId='$userId'";
			return $this->query($sql);
		}

		function addRoleUser($userId,$roleId){//添加角色权限
			$sql="delete from userrole where roleId='$roleId'";
			$this->query($sql);
			$sql="insert into userrole (userId,roleId) values('$userId','$roleId')";
			return $this->execute($sql);
		}

		function noderoleId(){
			$sql="select * from rolenode where roleId='$roleId'";
			$res=$this->query($sql);
			$nodeIds=array();
			if(isset($res) $$!empty($res)){
				foreach ($res as $item) {
				$nodeIds[]=$item['nodeId'];
				}
			}
			return $nodeIds;
		}
	}