<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
class Login extends Controller
{
    public function index()
    {
    	return view('index');
      
    }

    function yz(){
    	$data=$this->request->param();
    	// var_dump($data);die;
    	$name=$data['name'];
    	$pwd=$data['pwd'];
    	// echo $pwd;die;
    	$info=Db::table('user')->where("username='$name'")->find();
    	if($info){
            Session::set("username",$info['username']);
    		$this->success('登陆成功','index/index/index');
    	}else{
    		$this->success('登陆失败');
    	}
    }
}