<?php
namespace app\index\model;
use think\Model;
class IndexModel extends Model{
	function up($id,$name){
		$sql="update 2day16 set name='$name' where id='$id'";

		return $this->query($sql);
	}
}