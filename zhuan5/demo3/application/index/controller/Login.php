<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\model\UserModel;
class Login extends Controller{
	//登陆页面
	function index(){
		return view('index');
	}

	function login(){
		$data=$this->request->param();
		if(!isset($data['userName'])&&empty($data['userName'])){
			$this->error('用户不能为空','index/login/index');
		}
		if(!isset($data['password'])&&empty($data['password'])){
			$this->error('密码不能为空','index/login/index');
		}
		$user=new UserModel();
		$userinfo=$user->selects($data['userName']);
		if($userinfo[0]['userName']!=$data['userName']){
			$this->error('没有此用户','index/login/index');
		}
		if($userinfo[0]['password']!=$data['password']){
			$this->error('密码不正确','index/login/index');
		}
		$userid=$userinfo[0]['id'];
		//获取用户权限
		// $auth=$user->getnodesbyid($userid);
		//设置用户信息
		Session::set('userinfo',$userinfo[0]);
		// Session::set('auth',$auth);
	     $this->success('登陆成功','index/index/index');


	}
	function loginout(){
		Session::flush();
		$this->success('退出登录','index/login/index');
	}
   
}