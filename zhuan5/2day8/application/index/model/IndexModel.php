<?php
namespace app\index\model;
use think\Model;
use think\Db;
class IndexModel extends Model
{    
	 public $size=2;
	 function selects($name){
		$sql="select count(*) as count from 2day7 where name like '%$name%'";
		$data=$this->query($sql);
		$count=$data[0]['count'];
		$map['name']  = ['like',"%$name%"];
		$list =Db::name('2day7')->where($map)->paginate($this->size,$count);
		return $list;
	}

	function dels($ids){
		$str=implode(",",$ids);
		$sql="delete from 2day7 where id in($str)";
		// echo $sql;die;
		return $this->query($sql);
	}
	
}