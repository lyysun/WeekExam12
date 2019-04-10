<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\RoleModel;

class Userrole extends Rbac{
	function index(){
		$data=$this->request->param();
		// dump($data);die;
		$userId=$data['userId'];
		// echo $userId;die;
		$role=new RoleModel();
		$data=$role->select();
		// dump()
		$Userrole=$role->UserRoleUserId($userId);
		$roleId=0;
		if(!empty($Userrole)){
			$roleId=$Userrole[0]['roleId'];
		}
		$this->assign('roleId',$roleId);
		$this->assign('userId',$userId);
		$this->assign('data',$data);
		return view();
	}


    function add(){
    	$data=$this->request->param();
    	// dump($data);die;
    	$userId=$data['userId'];
    	$roleId=$data['roleId'];
    	$role=new RoleModel();
    	$res=$role->addUserRole($userId,$roleId);
    	if($res>0){
    		$this->success('添加成功','index/user/index');
    	}else{
    		$this->error('添加失败');
    	}

    }

}