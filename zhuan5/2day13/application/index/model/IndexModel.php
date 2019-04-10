<?php
namespace app\index\model;
use think\Model;
use think\Db;
class IndexModel extends Model
{
	function up($id,$sum){
		$sql="update 2day13 set tp='$sum' where id='$id'";
		return $this->query($sql);
	}

	function selects($name){
		$sql="select * from 2day13 where name like '%$name%'";
		return $this->query($sql);
	}
     function sel(){
		$sql="select * from 2day13 order by tp desc";
		return $this->query($sql);
	}
}