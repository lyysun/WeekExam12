<?php

class Server{
       // private $name;
       
	function __construct(){
           $this->s_name=$_GET['name'];    
           // $this->name=$name;
           $this->login();    
	}
	function login(){
		if($this->s_name){
			$arr=array("code"=>1,'msg'=>$this->s_name);
		}else{
			$arr=array("code"=>0,'msg'=>'error');
		}
		echo json_encode($arr);
	}
}
new Server();