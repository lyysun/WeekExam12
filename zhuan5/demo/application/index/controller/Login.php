<?php
	namespace app\index\controller;
	use think\Controller;
	use think\Session;
	use app\index\model\UserModel;
	/**
	 * 登陆控制类
	 */
	class Login extends Controller
	{
		/**
		 * 登陆显示页面
		 */
		public function index(){
			return view('index');
		}
		//登陆判断
		public function login(){
			$param=$this->request->param();
	        if(!isset($param['userName']) && empty($param['userName'])){
	            $this->error('用户名不能为空？','/index/login/index');
	        }
	        if(!isset($param['password']) && empty($param['password'])){
	            $this->error('密码不能为空？','/index/login/index');
	        }
	        //判断是否有这个用户
	        $user=new UserModel();
	        $userInfo=$user->gerUserInfoByUserName($param['userName']);
	        if($userInfo[0]['userName']!=$param['userName']){
	            $this->error('没有此用户','/index/login/index');
	        }
	        if($userInfo[0]['password']!=md5($param['password'])){
	            $this->error('密码错误','/index/login/index');
	        }
	        $userId=$userInfo[0]['id'];
	        //获取用户权限信息
	        $auth=$user->getNodesByUid($userId);
	        //设置用户信息
	        Session::set('userInfo',$userInfo[0]);
	        //设置权限信息
	        Session::set('auth',$auth);
	        $this->success('登陆成功','/index/index/index');
		}
		//退出登陆
		public function logout(){
			Session::flush();
			$this->success('退出登陆','/index/login/index');
		}
	}
