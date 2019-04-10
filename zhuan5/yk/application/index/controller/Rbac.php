<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Rbac extends Controller
{
    public function _initialize()
    {
        echo "这里是权限控制";
        $this->chek();
    }
    
    function chekauth(){
    	$this->error('对不起你没有权限访问');

    }
    function chek(){
    	$session=Session::get();
    	if($session){
    		$this->error('您没有，次权限，请登录','/index/login/index');
    	}
    }

}