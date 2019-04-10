<?php
	namespace app\index\model;
	use think\Model;
	class UserModel extends Model
	{
		public function gerUserInfoByUserName($userName){
			$sql="select * from user where userName='{$userName}'";
			return $this->query($sql);
		}
		public function addUser($userName,$password){
			$password=md5($password);
			$createDateTime=date('Y-m-d H:i:s',time());
			$sql="insert into user(userName,password,createDateTime) values('$userName','$password','$createDateTime')";
			$row=$this->execute($sql);
			$sql="select last_insert_id()";
			$id=$this->query($sql);
			return $id;
		}
		public function getUserList(){
			$sql="select * from user";
			return $this->query($sql);
		}
		public function deleteUserByUid($uid){
			$sql="delete from user where id = {$uid}";
			return $this->query($sql);
		}
		public function getUserInfoByUid($uid){
			$sql="select * from user where id={$uid}";
			return $this->query($sql);
		}
		public function updateUserNameByUid($uid,$userName){
			$sql="update user set userName='$userName' where id={$uid}";
			return $this->query($sql);
		}
		public function addUserRole($uid,$roleId){
			$sql="delete from userRole where userId={$uid}";
			$this->query($sql);
			$sql="insert into userRole(userId,roleId) values('$uid','$roleId')";
			$this->execute($sql);
			$sql="select last_insert_id()";
			$id=$this->query($sql);
			return $id;
		}
		//获取用户的权限信息
		public function getNodesByUid($uid){
        	$sql="select u.id,n.* from user as u left join userRole as ur on u.id=ur.userId left join roleNode as rn on ur.roleId=rn.roleId left join node as n on rn.nodeId=n.id where u.id={$uid}";
        	$userNode=$this->query($sql);
        	$sql="select * from node where pid=0";
        	$parentNodes=$this->query($sql);
        	$tempData=array();
        	if(isset($parentNodes) && !empty($parentNodes)){
        		foreach($parentNodes as $parent){
        			$tempData[$parent['id']]=$parent;
        		}
        	}
        	$auths=array();
        	if(isset($userNode) && !empty($userNode)){
        		foreach($userNode as $item){
        			if(isset($tempData[$item['pid']])){
        				$auths[$tempData[$item['pid']]['nodeName']][]=$item['nodeName'];
        			}
        		}
        	}
        	return $auths;
    	}
	}