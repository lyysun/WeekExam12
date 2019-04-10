<?php
namespace app\index\model;
use think\Model;

class IndexModel extends Model
{
	function select(){
		$sql="select * from 2day1";
		return $this->query($sql);
	}

	function updates($id,$name){
		$sql="update 2day1 set name='$name' where id='$id'";
		// echo $sql;die;
		return $this->query($sql);
	}
}