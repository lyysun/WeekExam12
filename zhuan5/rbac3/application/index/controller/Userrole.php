<?php
namespace app\index\controller;
use  app\index\controller\Rbac;
use  app\index\model\RoleModel;

class UserRole extends Rbac
{
	function index(){
		$data=$this->request->param();//接收参数
		// dump($data);die;
		if(!isset($data['userId']) || empty($data['userId'])){
			$this->error('参数不合格','index/user/index');
		}//查询所有角色
		 $role=new RoleModel();
		 $roleList=$role->selects();
		 //查询当前id
		 $userRole=$role->getUserRoleIdByUserId($data['userId']);
		 $roleId=0;
          // dump($userRole);
		 if(!empty($userRole)){
		 	$roleId=$userRole[0]['roleId'];
		 	// dump($roleId);die;
		  }
		 
		 $this->assign('roleId',$roleId);	
		 $this->assign('userId',$data['userId']);
		 $this->assign('roleList',$roleList);
		
		return view(); 
	}
     
     function add(){
     	$data=$this->request->param();
     	if(!isset($data['userId']) || empty($data['userId'])){
     		$this->error("未知参数",'index/user/index');
     	}
     	 $roleId=$data['roleId'];
     	 $userId=$data['userId'];
     	 $role=new RoleModel();
     	 $res=$role->addUserRole($userId,$roleId);
          if($res){
          	$this->success('分配角色成功','index/user/index');
          }else{
          	$this->error('分配角色失败','index/user/index');
          }
     }

}

  