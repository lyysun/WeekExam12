<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Rbac extends Controller
{
	public function _initialize(){
     echo '这是权限管理'.'<br>';
     $this->checkLogin();
     $this->welcome();
     // $this->checkAuth();
     
   }
   public function welcome(){
    		$session=Session::get();
    		$str="<center>";
    		$str.="欢迎您:{$session['userName']}";
    		$str.="<a href='/index/login/index'>退出登陆</a>";
    		$str.="</center>";
    		$str.="<a href='/index/index/index' style='position:fixed;right:10px;bottom:30px;'>回到首页</a>";
    		echo $str;
    	}

    	function checkLogin(){
    		 $session=Session::get();

    		if(empty($session['userName'])){
    			$this->error('请先登录','/index/login/index');
    		}
    	}




    	function checkAuth(){
    		$session=Session::get();
    	
    		$controller=strtolower($this->request->Controller());
            // echo $controller;die;
    	
    		$action=strtolower($this->request->Action());
       // var_dump($action);die;
    		if(!array_key_exists($controller,$session['auth'])){
    			$this->error('你没有权限访问{$controller}控制层','/index/index/index');
    		}else{
                if(!in_array($action,$session['auth'][$controller])){
                    $this->error("您没有权限访问{$controller}控制层{$action}方法",'index/index/index');
                }

            }
    	}
}