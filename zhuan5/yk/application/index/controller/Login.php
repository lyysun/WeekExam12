<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
class Login extends Controller
{
    public function index()
    {
       return view();
    }

    function yz(){
    	$data=$this->request->param();
    	$userName=$data['userName'];
    	$password=$data['password'];
    	$info=Db::table('user')->where("userName='$userName' and password='$password'")->find();
    	if($info){
             Session::set('userName',$info);
    		$this->success("登陆成功",'index/index/index');
    	}else if(Db::table('user')->where("password='$password'")->find()){
    		$this->error('用户名错误');
    	}else{
    		$this->error('密码错误');
    	}
    }
}