<?php
namespace app\index\controller;
use think\Controller;
use app\index\controller\Rbac;
use think\Session;
class Index extends Rbac
{
    public function index()
    {    //获取用户
    	$session=Session::get();
    	$uid=Session::get('uid');
       // dump($session);
    	$node=Db("node")->select();
    	$this->assign("data",$node);
    	$this->assign("uid",$uid);
    	return view();
        
    }
}
