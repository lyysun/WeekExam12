<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Controller;
use app\index\model\RoleModel;

class UserRole extends Rbac
{
	function index(){
		$data=$this->request->param();
		// dump($data);die;
		$userId=$data['userId'];
		// dump($userId);die;
		$user=new RoleModel();
		$data=$user->selects();
		// var_dump($data);die;
		$userRole=$user->RoleUserId($userId);
		// dump($userRole);die;
		$roleId=0;
		if(!empty($userRole)){
			$roleId=$userRole[0]['roleId'];
		}
		$this->assign('roleId',$roleId);
		$this->assign('userId',$userId);
		$this->assign('data',$data);
		return view();
	}

	function add(){
		$data=$this->request->param();
		$roleId=$data['roleId'];
		$userId=$data['userId'];
		$user=new RoleModel();
		$res=$user->addRoleUser($roleId,$userId);
       if($res){
       	$this->success('添加成功','index/user/index');
       }
	}
}