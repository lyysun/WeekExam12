<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class RoleModel extends Model
{
	function add($roleName){
		$sql="insert into role (roleName) values('$roleName')";
		return $this->execute($sql);
		// return Db::table('role')->insert($data);
	}
	function selects(){
		$sql="select * from role";
		return $this->query($sql);
	}

	function deletes($id){
		$sql="delete from role where id={$id}";
		return $this->query($sql);
		// return Db::table('role')->where('id',$id)

	}

	function updates($id){
		$sql="select * from role where id={$id}";
		return $this->query($sql);

	}

	function updatedos($id,$roleName){
		$sql="update role set roleName='$roleName' where id={$id}";
		return $this->query($sql);

	}

	function getUserRoleIdByUserId($userId){
		$sql="select roleId from userrole where userId={$userId}";
		// echo $sql;die;
        	return $this->query($sql);

	}

	function addUserRole($userId,$roleId){//角色
		//清空
		$sql="delete from userrole where userId={$userId}";
	    $this->query($sql);
	    //新增
		$sql="insert into userrole (userId,roleId) values('$userId','$roleId')";
		return $this->execute($sql);
	}
   
   function getNodeIdsByRoleId($roleId){//权限查询所选中的权限
   	 $sql="select * from roleNode where roleId='{$roleId}'";
   	// echo $sql;die;
   	 $res= $this->query($sql);
   	 // dump($res);die;
   	 $nodeIds=array();
   	 if(isset($res) && !empty($res)){
             foreach ($res as $item) {
             	// dump($item);die;
             $nodeIds[]=$item['nodeId'];
             // dump($nodeIds);die;
             }
   	 }
       // dump($nodeIds);die;
   	 return $nodeIds;//角色选中的权限
   }

   function addRoleNode($roleId,$nodeIds){
   	$bj=true;
   	$sql="delete from roleNode where roleId='$roleId'";//清除一下缓存

   	$this->query($sql);
   	
   	foreach ($nodeIds as $v) {//便利权限添加数据
   	$sql="insert into roleNode (roleId,nodeId) values('$roleId','$v')";
   	// dump($nodeIds);die;
   	$res=$this->execute($sql);
   	// echo $res;die;
   	if(!$res){
   		 $bj=false;
   			$sql="delete from roleNode where roleId='$roleId'";
   			// echo $sql;die;
   	        $this->query($sql);
    	}
   	}
   	// echo $bj;die;
   	return $bj;
   }

}