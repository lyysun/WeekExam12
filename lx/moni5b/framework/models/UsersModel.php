<?php 
namespace app\models;
use app\models\DBHelp;
/**
* 
*/
class UsersModel extends DBHelp
{
	public function add($name,$sex,$age,$time,$pwd){
		$sql="insert into ceshi (name,sex,age,time,pwd) values('$name','$sex','$age','$time',$pwd)";
	   return $this->add2($sql);
	}
	public function checkUserName($id){
		$sql="select name from ceshi where id=$id";
		return $this->select($sql);
	}
	public function getUserByName($name){
		$sql="select * from ceshi where name='$name'";
		return $this->select($sql);
	}
    public function login($name,$pwd){
    	$sql="select name,pwd from ceshi where name='$name' and pwd='$pwd'";
    	return $this->select($sql);
    }	
	
}

?>