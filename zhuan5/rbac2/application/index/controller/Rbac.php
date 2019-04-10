<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Rbac extends Controller
{
    public function _initialize()
    {
      echo "这是权限控制";
        // $this->checklogin();
      // $this->welcome();
      // $this->controller();

    }

    function welcome(){

    	$session=Session::get();
    	// echo $session;die;
    	$str="欢迎{$session['username']}";
    	$str.="<a href='/index/login/index'>退出登录</a>";
    	echo $str;
    }

    function checklogin(){
    	$session=Session::get();
    	if(empty($session['name'])){
    		$this->error('请先登录','index/login/index');
    	}
    }
    function controller(){
        $this->error('你没有控制层权限','index/login/index');
    }
}