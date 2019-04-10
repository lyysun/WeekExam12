<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class RoleModel extends Model
{   
	function adds($data){
		return Db::table('role')->insert($data);
	}
	function selects(){
		return Db::table('role')->select();
	}
	function deletes($id){
		return Db::table('role')->where('id',$id)->delete();
	}
	function get_one($id){
		return Db::table('role')->where('id',$id)->find();
	}
	function updates($id,$data){
		return Db::table('role')->where('id',$id)->update($data);
	}
	
	function addRoleNodes($roleId,$nodeIds){
		$sql="delete from roleNode where roleId={$roleId}";
		// echo $sql;die;
		$this->query($sql);
		if(isset($nodeIds) && !empty($nodeIds)){
				foreach($nodeIds as $nodeId){
					$sql="insert into roleNode(roleId,nodeId) values('$roleId','$nodeId')";
					$this->execute($sql);
					$sql="select last_insert_id()";
					$id=$this->query($sql);
					if($id<0){
						return false;
					}
				}
			}
		return true;

	}
}