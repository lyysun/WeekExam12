<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Request;
use app\index\model\UserModel;
class User extends Rbac
{
	function index(){
		return view('add');
	}

	function add(){
		$data=Request::instance()->param();
		$userName=Request::instance()->param('userName');
		// echo $userName;die;
		if(empty($userName)){
			$this->error('用户名不能为空','index/user/index');
		}
		$user=new UserModel();
		$res=$user->adds($data);
		if($res){
			$this->success('添加成功','index/user/show');
		}

	}

	function show(){

		$user=new UserModel();
		$data=$user->selects();
		$this->assign('data',$data);
		return $this->fetch('show');
	}
	function delete(){

		$id=Request::instance()->param('id');
		$user=new UserModel();
		$res=$user->deletes($id);
		if($res){
			$this->success('删除成功','/index/user/show');
		}else{
			$this->error('删除失败');
		}
	}

    function update(){
    	$data=Request::instance()->param('id');
    	$user=new UserModel();
    	$data=$user->get_one($data);
    	$this->assign('data',$data);
    	return $this->fetch('update');
    }
    function updatedo(){
    	$id=Request::instance()->param('id');
    	$data=Request::instance()->param();
    	$user=new UserModel();
    	$res=$user->updates($id,$data);
    	if($res){
    		$this->success('修改成功','index/user/show');
    	}else{
    		$this->error('修改失败');
    	}
    }

     public function userRole(){
        header("content-type:text/html;charset=utf8");
        $uid=$this->request->post('uid');
        $roleId=$this->request->post('roleId');

        $user=new UserModel();
        $id=$user->addUserRole($uid,$roleId);
      if($id){
        $this->success('分配角色成功');
      }else{
        $this->error('分配角色失败');
      }

    }
}