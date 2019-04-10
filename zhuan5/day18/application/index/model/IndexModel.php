<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class IndexModel extends Model
{
	private $Size1=2;
	function select($page,$bt){
		$sql="select count(*) as count from day18 where bt like '%$bt%'";
		$data=$this->query($sql);
		$count=$data[0]['count'];
		$map['bt']  = ['like',"%$bt%"];
		$list = Db::name('day18')->where($map)->paginate($this->Size1,$count);
		return $list;

	}

	function delall($id){
		// $ids=implode(',',$ids);
		$sql="delete from day18 where id in ($id)";
		// echo $sql;die;
		return $this->query($sql);

	}
	function selects(){
		$sql="select * from day18";
		return $this->query($sql);
	}
}