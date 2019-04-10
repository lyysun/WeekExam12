<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\RoleModel;
use think\Request;
class Role extends Rbac
{
	function index(){
		return view('add');
	}

	function add(){
		$data=Request::instance()->param();
		$role=new RoleModel();
		$res=$role->adds($data);
		if($res){
			$this->success('添加成功','index/role/show');
		}

	}

	function show(){

		$Role=new RoleModel();
		$data=$Role->selects();
		$this->assign('data',$data);
		return $this->fetch('show');
	}
	function delete(){

		$id=Request::instance()->param('id');
		$Role=new RoleModel();
		$res=$Role->deletes($id);
		if($res){
			$this->success('删除成功','/index/Role/show');
		}else{
			$this->error('删除失败');
		}
	}

    function update(){
    	$data=Request::instance()->param('id');
    	$Role=new RoleModel();
    	$data=$Role->get_one($data);
    	$this->assign('data',$data);
    	return $this->fetch('update');
    }
    function updatedo(){
    	$id=Request::instance()->param('id');
    	$data=Request::instance()->param();
    	$Role=new RoleModel();
    	$res=$Role->updates($id,$data);
    	if($res){
    		$this->success('修改成功','index/Role/show');
    	}else{
    		$this->error('修改失败');
    	}
    }

    function addRoleNode(){
    
    	$post=$this->request->post();
    	// echo $post;die;
            $roleId=$post['roleId'];
            $nodeIds=$post['nodeIds'];
    	$role=new RoleModel();
    	$res=$role->addRoleNodes($roleId,$nodeIds);
    	if($res){
    		$this->success('添加权限成功','index/role/show');
    	}else{
    		$this->error('添加权限失败');
    	}
    }
	   
}