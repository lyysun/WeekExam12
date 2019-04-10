<?php
namespace app\index\controller;
use  app\index\controller\Rbac;
use  app\index\model\RoleModel;

class Role extends Rbac
{
	function index(){
		$role=new RoleModel();
		$data=$role->selects();
		$this->assign('data',$data);
		return view('index');
	}

	function add(){
		$data=$this->request->param();
		$roleName=$data['roleName'];
		// echo $roleName;die;
		$role=new RoleModel();
         $res=$role->add($roleName);
         if($res>0){
         	$this->success('添加成功','index/role/index');
         }else{
         	$this->error('添加失败','index/role/index');
         }
	}

	 function delete(){
      	$data=$this->request->param();
      	$id=$data['id'];
      	// echo $id;die;
      	$role=new RoleModel();
      	$res=$role->deletes($id);
      	if($res>0){
			$this->success('删除成功','index/role/index');
		}else{
			$this->error('删除失败','index/role/index');
		}
      }

      function update(){
      		$data=$this->request->param();
      	    $id=$data['id'];
      	    // echo $id;die;
      	  	$role= new RoleModel();
		    $data=$role->updates($id);
		    // dump($data);die;
		    $this->assign('data',$data[0]);

	     	return view('update');
      }
      
       function updatedo(){
      	$data=$this->request->param();
      	$id=$data['id'];
      	$roleName=$data['roleName'];
      	// echo $id;die;
      	$role=new RoleModel();
      	$res=$role->updatedos($id,$roleName);
      	if($res>0){
			$this->success('修改成功','index/role/index');
		}else{
			$this->error('修改失败','index/role/index');
		}
      }


}