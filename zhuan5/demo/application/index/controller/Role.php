<?php
namespace app\index\controller;
use think\Request;
use app\index\controller\Rbac;
use app\index\model\RoleModel;
/**
 * 角色控制器
 */
class Role extends Rbac
{
	//添加角色页面
    public function index()
    {
        return view('index');
    }
    //添加角色入库
    public function add(){
    	$roleName=$_POST['roleName'];
    	if(empty($roleName)){
    		$this->error('角色名称不能为空','/index/role/index');
    	}
    	//入库操作
    	$role=new RoleModel();
    	$id=$role->addRole($roleName);
    	if($id<=0){
    		$this->error('添加角色失败','/index/role/index');
    	}
    	$this->error('添加角色成功','/index/role/showList');
    }
    //角色列表
    public function showList(){
        $request=Request::instance();
        $uid=$request->param('uid');
    	$role=new RoleModel();
    	$data=$role->getRoleList();
        $this->assign('uid',$uid);
    	$this->assign('roles',$data);
    	return view('showList');
    }
    //删除角色
    public function delete(){
    	$request=Request::instance();
    	$roleId=$request->param('roleId');
    	$role=new RoleModel();
    	$row=$role->deleteUserByRoleId($roleId);
    	if($row<=0){
    		$this->error('删除失败','/index/role/showList');
    	}
    	$this->success('删除成功','/index/role/showList');
    }
    //修改用户页面
    public function update(){
    	$request=Request::instance();
    	$roleId=$request->param('roleId');
    	$role=new RoleModel();
    	$roleInfo=$role->getRoleInfoByRoleId($roleId);
    	$this->assign('roleInfo',$roleInfo[0]);
    	return view('update');
    }
    //修改用户入库
    public function doupdate(){
    	$request=Request::instance();
    	$roleId=$request->param('roleId');
    	$roleName=$request->param('roleName');
    	$role=new RoleModel();
    	$rows=$role->updateRoleNameByRoleId($roleId,$roleName);
    	if($rows<=0){
    		$this->error('修改失败','/index/role/showList');
    	}
    	$this->success('修改成功','/index/role/showList');
    }
    //添加角色权限
    public function addRoleNode(){
        $request=Request::instance();
        $post=$request->post();
        if(empty($post)){
            $this->error('参数出错误','/index/role/showList');
        }
        $roleId=$post['roleId'];
        $nodeIds=$post['nodeIds'];
        if(empty($roleId)){
            $this->error('未知角色','/index/role/showList');
        }
        if(empty($nodeIds)){
            $this->error('未知权限','/index/role/showList');
        }
        $role=new RoleModel();
        $res=$role->addRoleNodes($roleId,$nodeIds);
        if(!$res){
            $this->error('添加权限失败','/index/role/showList');
        }
        $this->success('添加权限成功','/index/role/showList');
    }
}
