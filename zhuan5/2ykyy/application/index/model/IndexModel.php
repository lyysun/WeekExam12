<?php
namespace app\index\model;
use think\Model;
class IndexModel extends Model
{ 
	public $size=3;
  function select(){
  	$sql="select count(*) as count from type";
  	$data=$this->query($sql);
  	$count=$data[0]['count'];
  	$list=Db('type')->paginate($this->size,$count);
  	return $list;
  }
  function xg($id,$name){
  	$sql="update type set fy='$name' where id='$id'";
  	return $this->query($sql);
  }

}
