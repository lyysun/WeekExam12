<?php 
namespace app\controllers;
use app\models\UsersModel;
class UsersController{
	private $_model;
	public function __construct(){
           $this->_model=new UsersModel();
	}
	public function register(){
	        if($_POST){

                 $name=$_POST['name'];
                 $sex=$_POST['sex'];
                 $age=$_POST['age'];
                 $time=$_POST['time'];
                 $pwd=$_POST['pwd'];
                 // var_dump($name);die;
                 $res=$this->_model->getUserByName($name);
                 if($res){
                 	echo "用户名重复";
                 }
 
                 $res=$this->_model->add($name,$sex,$age,$time,$pwd);
                if($res){
                	echo '添加成功';
	        	 }

		}else{
			return view("register");
		   }
              
			
	}

	public function login(){
		if($_POST){
             
             $name=$_POST['name'];
             $pwd=$_POST['pwd'];
             $res=$this->_model->login($name,$pwd);
               if($res){
               	echo "登陆成功";
               }else{
               	echo "密码或账号有误！";
               }
		}else{
			return view("login");
		}
		
	}
}

?>