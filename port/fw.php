<?php
header("Content-type:text/html;charset=utf-8");
class Server{

	private $name;
	private $s_pwd="123";
	function __construct(){
             
             $this->name=$_GET['name'];
             $this->c_pwd=$_GET['pwd'];
             // var_dump($this->pwd);die;
             $this->login();
	}

	function login(){
             if($this->c_pwd==$this->s_pwd){
             	$arr=array(
                     'code'=>1,
                     'msg'=>"success",
             		);
             }else{
             	$arr=array(
                     'code'=>0,
                     'msg'=>"error",
             		);
             }
        echo json_encode($arr);  
	}

}
new Server();