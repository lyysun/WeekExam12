<?php
namespace app\index\Model;
use think\Model;
use think\Db;

class UserModel extends Model
{
	function adds($data){//添加数据
		return Db::table('user')->insert($data);
	}
	function selects(){//展示数据
		return Db::table('user')->select();
	}
	function deletes($id){//删除数据
		return Db::table('user')->where('id',$id)->delete();
	}
	function get_one($id){//查询一条数据
		return Db::table('user')->where('id',$id)->find();
	}
	function updates($id,$data){//修改数据
		return Db::table('user')->where('id',$id)->update($data);
	}
    

    function addUserRole($uid,$roleId){//用户添加角色
    	$sql="delete from userRole where userId={$uid}";
    	$this->query($sql);
    	$sql="insert into userRole(userId,roleId) values('$uid','$roleId')";
    	$this->execute($sql);
    	$sql="select last_insert_id()";
    	$id=$this->query($sql);
    	return $id;

    }

  public function getNodesByUid($uid){
            $sql="select u.id,n.* from user 
                     as u left join userRole 
                     as ur on u.id=ur.userId left join roleNode 
                     as rn on ur.roleId=rn.roleId left join node 
                     as n on rn.nodeId=n.id where u.id={$uid}";
            $userNode=$this->query($sql);
            $sql="select * from node where pid=0";
            $parentNodes=$this->query($sql);
            
            $tempData=array();
            if(isset($parentNodes) && !empty($parentNodes)){
                foreach($parentNodes as $parent){
                    $tempData[$parent['id']]=$parent;
                }
            }
            $auths=array();
            if(isset($userNode) && !empty($userNode)){
                foreach($userNode as $item){
                    if(isset($tempData[$item['pid']])){
                        $auths[$tempData[$item['pid']]['nodeName']][]=$item['nodeName'];
                    }
                }
            }
            return $auths;
        }
        
}