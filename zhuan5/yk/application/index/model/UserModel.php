<?php
namespace app\index\model;
use think\Model;
use think\Db;
class UserModel extends Model
{    
	private $size=2;
	function add($name,$sex,$bj,$xh){
		$sql="insert into stuend (name,sex,bj,xh) values('$name','$sex','$bj','$xh')";
		return $this->execute($sql);
	}
	function select($name){
		$sql="select count(*) as count from stuend where name like '%$name%'";
		
		$data= $this->query($sql);
		$count=$data[0]['count'];
		$map['name']  = ['like',"%$name%"];
		$data = Db::name('stuend')->where($map)->paginate($this->size,$count);
		return $data;

	}
	function del($id){
		$sql="delete from stuend where id='$id'";
		return $this->query($sql);
	}
	function delall($ids){
		$ids=implode(',',$ids);
		$sql="delete from stuend where id in($ids)";
		return $this->query($sql);
	}
	function status($id,$status){
		$sql="update stuend set status='$status' where id='$id'";
		// echo $sql;die;
		return $this->query($sql);
	}
}