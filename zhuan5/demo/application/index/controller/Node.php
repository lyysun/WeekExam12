<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\NodeModel;
use think\Request;
/**
 * 权限控制器
 */
class Node extends Rbac
{
	//添加权限页面
    public function index()
    {
        return view('index');
    }
    //添加角色入库
    public function add(){
    	$nodeName=$_POST['nodeName'];
    	$nodeDes=$_POST['nodeDes'];
    	$pid=$_POST['pid'];
    	if(empty($nodeName)){
    		$this->error('权限名称不能为空','/index/node/index');
    	}
    	if(empty($nodeDes)){
    		$this->error('权限描述名称不能为空','/index/node/index');
    	}
    	if($pid<0 || !is_numeric($pid)){
    		$this->error('权限父级id不正确','/index/node/index');
    	}
    	//入库操作
    	$node=new NodeModel();
    	$id=$node->addNode($nodeName,$nodeDes,$pid);
    	if($id<=0){
    		$this->error('添加权限失败','/index/node/index');
    	}
    	$this->error('添加权限成功','/index/node/showList');
    }
    //角色列表
    public function showList(){
        $request=Request::instance();
        $roleId=$request->param('roleId');
    	$node=new NodeModel();
    	$data=$node->getNodeList();
        $this->assign('roleId',$roleId);
    	$this->assign('nodes',$data);
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
}
