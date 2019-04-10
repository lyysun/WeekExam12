<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
class Login extends Controller{
	     function index(){
	     	return view();
	     }
	     function getCode(){
	     	return view();

	     }

	     function login(){
	     	$data=$this->request->param();
	     	// dump($data);die;
	     	$userName=$data['userName'];
	     	$password=$data['password'];
             $info=Db::table('user')->where("userName='$userName' and password='$password'")->find();
             // echo $info;die;
             if($info){
             	Session::set('userName',$info['userName']);
             	$this->success('登陆成功','index/index/index');
             }else{
             	$rhis->error('登陆失败');
             }


	     }

}