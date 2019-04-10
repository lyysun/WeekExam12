<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Request;
use app\index\model\UserModel;
//首页
class User extends Rbac
{
    public function index()
    {
    	return view('index');
    }
    public function add(){
    	$request=Request::instance();
    	$userName=$request->post('userName');
    	$password=$request->post('password');
    	if(empty($userName)){
    		$this->error('用户名不能为空','/index/user/index');
    	}
    	if(empty($password)){
    		$this->error('密码不能为空','/index/user/index');
    	}
    	$user=new UserModel();
    	$id=$user->addUser($userName,$password);
    	if($id<=0){
    		$this->error('添加用户失败','/index/user/index');
    	}
    	$this->success('添加用户成功','/index/user/showList');
    }
    public function showList(){
    	header('content-type:text/html;charset=utf-8');
    	$user=new UserModel();
    	$data=$user->getUserList();
    	$this->assign('users',$data);
    	return $this->fetch('showList');
    }
    public function delete(){
    	$request=Request::instance();
    	$uid=$request->param('uid');
    	$user=new UserModel();
    	$row=$user->deleteUserByUid($uid);
    	if($row<=0){
    		$this->error('删除失败','/index/user/showList');
    	}
    	$this->success('删除成功','/index/user/showList');
    }
    public function update(){
    	$request=Request::instance();
    	$uid=$request->param('uid');
    	$user=new UserModel();
    	$userInfo=$user->getUserInfoByUid($uid);
    	$this->assign('userInfo',$userInfo[0]);
    	return $this->fetch('update');
    }
    public function doupdate(){
    	$request=Request::instance();
    	$uid=$request->param('uid');
    	$userName=$request->param('userName');
    	$user=new UserModel();
    	$rows=$user->updateUserNameByUid($uid,$userName);
    	if($rows<=0){
    		$this->error('修改失败','/index/user/showList');
    	}
    	$this->success('修改成功','/index/user/showList');
    }
}
