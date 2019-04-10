<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class RoleModel extends Model
{

	function add($data){
		return Db::table('role')->insert($data);
	}
    function select(){
		return Db::table('role')->select();
	}
	function deletes($id){
		return Db::table('role')->where('id',$id)->delete();
	}


	function UserRoleUserId($userId){
		// $sql="select roleId from userrole where userId={$userId}";
		$sql="select roleId from userrole where userId={$userId}";
		// echo $sql;die;
		return $this->query($sql);
	}

	function addUserRole($userId,$roleId){
		// $sql="delete from userrole where userId={$userId}";
		// $this->query($sql);
		// $sql="insert into userrole (userId,roleId) values('$userId',$roleId)";
		// return $this->execute($sql);

		$sql="delete from userrole where userId={$userId}";
		$this->query($sql);
		$sql="insert into userrole (userId,roleId) values('$userId','$roleId')";
		return $this->query($sql);
	}

	function rolenodeid($roleId){
        $sql="select * from rolenode where roleId='{$roleId}'";
       $res= $this->query($sql);
       $nodeIds=array();
       if(isset($res) && !empty($res)){
       	           foreach ($res as $item) {
       	          $nodeIds[]=$item['nodeId'];
       	           }
       }
       return $nodeIds;
	}

	function addrolenode($roleId,$nodeIds){
		$bj=true;
		$sql="delete from rolenode where roleId='$roleId'";
		$this->query($sql);
		foreach ($nodeIds as $v) {
			$sql="insert into rolenode (roleId,nodeId) values('$roleId','$v')";
			$res=$this->execute($sql);
			if(!$res){
				$bj=false;
				$sql="delete from rolenode where roleId='$roleId'";
				$this->query($sql);
			}
		}
		return $bj;
	}
}