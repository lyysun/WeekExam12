<?php
namespace app\index\Model;
use think\Model;
class IndexModel extends Model
{    
	function select(){
		$sql="select * from day19";
		return $this->query($sql);
	}
	function updata($id,$status){
		$sql="update day19 set sj='$status' where id={$id}";
		return $this->query($sql);
	}
	function up($id,$status){
		$sql="update day19 set jp='$status' where id={$id}";
		return $this->query($sql);
	}

}