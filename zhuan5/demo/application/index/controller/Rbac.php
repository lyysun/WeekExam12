<?php
	namespace app\index\controller;
	use think\Controller;
	use think\Session;
	/**
	 * 权限控制类
	 */
	class Rbac extends Controller
	{
		//初始化方法
		public function _initialize()
    	{
    		header('content-type:text/html;charset=utf-8');
    		$this->checkLogin();
    		// $this->checkAuth();
    		$this->welcome();
    	}
    	public function welcome(){
    		$session=Session::get();
    		$str="<center>";
    		$str.="欢迎您:{$session['userInfo']['userName']}";
    		$str.="<a href='/index/login/logout'>退出登陆</a>";
    		$str.="</center>";
    		$str.="<a href='/index/index/index' style='position:fixed;right:10px;bottom:30px;'>回到首页</a>";
    		echo $str;
    	}
    	//检测登陆方法
    	public function checkLogin(){
    		$session=Session::get();
    		if(empty($session['userInfo'])){
    			$this->error('您还没有登陆请登陆!','/index/login/index');
    		}
    	}
    	public function checkAuth(){
    		$session=Session::get();
    		$controller=strtolower($this->request->Controller());
    		$action=strtolower($this->request->Action());
    		if(!array_key_exists($controller, $session['auth'])){
    			echo "<script>alert('您没有权限访问{$controller}控制层')</script>";die;
    		}else{
    			if(!in_array($action,$session['auth'][$controller])){
    				echo "<script>alert('您没有权限访问{$controller}控制层{$action}方法')</script>";die;
    			}
    		}
    	}
	}