<?php
namespace app\index\model;
use think\Model;
use think\Session;
use think\Request;
use think\Db;
class IndexModel extends Model
{    public $size=2;
	function selects($name){
	
		$sql="select count(*) as count from student where name like '%$name%'";
		// dump($sql);
		$data=$this->query($sql);
		$count=$data[0]['count'];
		$map['name']  = ['like',"%$name%"];
		$list=Db("student")->where($map)->paginate($this->size,$count);
		return $list;
	}
	function delall($ids){
        $ids=implode(',',$ids);
        $sql="delete from student where id in($ids)";
        return $this->query($sql);
	}
	function xg($id,$name){
		$sql="update student set name='$name' where id='$id'";
		return $this->query($sql);
	}
}