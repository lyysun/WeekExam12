<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\UserModel;
use think\Request;
use think\Db;
use think\Session;
class Login extends Controller
{
	function index(){
		return view('login');
	}

	function login(){
	     $data=Request::instance()->param();
         $name=$data['userName'];
         $pwd=$data['password'];
        
        //实例化
         $info=Db::table('user')->where("userName='$name'and password='$pwd'")->find();
        
         if($info){
           
               $user=new UserModel();
               $userId=$info['id'];
               // $userId=$info['id'];
                $auth=$user->getNodesByUid($userId);
              // var_dump($auth);die;

                Session::set('auth',$auth);

                Session::set('userName',$info['userName']);
            $this->success('登陆成功',"index/index/index");
         }else{
            $this->error('登录失败');
         }
        // echo $b;die;
       
	}
    // function logout(){
    //         Session::flush();
    //      return $this->fetch('index/login/index');
    //     }
	
}