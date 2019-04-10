<?php
	namespace app\index\model;
	use think\Model;
	class UserModel extends Model
	{
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
	}