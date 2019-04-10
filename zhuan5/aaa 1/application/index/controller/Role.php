<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\RoleModel;
/**
 * 首页
 */
class Role extends Rbac
{
    //首页信息展示(用户总数|角色总数|权限总数)
    public function index()
    {
    	$role=new RoleModel;
    	$roles=$role->getRoleList();
        $uid=$this->request->param('uid');
        if(!empty($uid)){
            $roleIds=$role->getRoleIdsByUid($uid);
            $this->assign('roleIds',$roleIds);
            $this->assign('uid',$uid);
        }
    	$this->assign('roles',$roles);
        return view('index');
    }
    public function add(){
    	//接受参数
    	$post=$this->request->post();
    	$roleName=$post['roleName'];
    	//判断参数是否合法
    	if(empty($roleName)){
    		$this->error('角色名称不能为空','/index/role/index');
    	}
    	//这里进行插入数据
    	$role=new RoleModel;
    	$rows=$role->addRole($roleName);
    	if($rows<=0){
    		$this->error('插入失败','/index/role/index');
    	}
    	$this->success('插入成功','/index/role/index');
    }
    public function delete(){
    	$param=$this->request->param();
    	$rid=$param['rid'];
    	if(empty($rid)){
    		$this->error('角色Id不能为空','/index/role/index');
    	}
    	$role=new RoleModel;
    	$rows=$role->delRole($rid);
    	if($rows<=0){
    		$this->error('删除失败','/index/role/index');
    	}
    	$this->success('删除成功','/index/role/index');
    }
    public function update(){
    	$param=$this->request->param();
    	if(!isset($param['roleId']) && empty($param['roleId'])){
    		$this->error('角色Id不能为空','/index/role/index');
    	}
        $rid=$param['roleId'];
    	$role=new RoleModel;
    	$roleInfo=$role->getRoleInfo($rid);
    	$this->assign('roleInfo',$roleInfo[0]);
    	return view('update');
    }
    public function doUpdate(){
    	$post=$this->request->post();
    	$rid=$post['rid'];
    	$roleName=$post['roleName'];
    	//判断参数是否合法
    	if(empty($rid)){
    		$this->error('用户Id不能为空','/index/role/index');
    	}
    	if(empty($roleName)){
    		$this->error('用户名不能为空','/index/role/index');
    	}
    	$role=new RoleModel;
    	$rows=$role->updateRole($rid,$roleName);
    	if($rows<=0){
    		$this->error('修改失败','/index/role/index');
    	}
    	$this->success('修改成功','/index/role/index');
    }
    public function addUserRole($uid,$roleId){
        $sql="delete from userRole where userId={$uid}";
        $this->query($sql);
        $sql="insert into userRole(userId,roleId) values('$uid','$roleId')";
        $this->execute($sql);
        $sql="select last_insert_id()";
        $id=$this->query($sql);
        return $id;
    }
    public function addRoleNode(){
        $post=$this->request->post();
        if(empty($post)){
            $this->error('参数出错误','/index/role/index');
        }
        $roleId=$post['roleId'];
        if(empty($roleId)){
            $this->error('未知角色','/index/role/index');
        }
        $nodeIds=$post['nodeIds'];
        if(empty($nodeIds)){
            $this->error('未知权限','/index/role/index');
        }
        $role=new RoleModel();
        $res=$role->addRoleNodes($roleId,$nodeIds);
        if(!$res){
            $this->error('添加权限失败','/index/role/index');
        }
        $this->success('添加权限成功','/index/role/index');
    }
}
