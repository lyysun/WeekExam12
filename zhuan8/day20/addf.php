<?php 

/**
* 
*/
class ADD
{
		   private $name;
	function __construct()
	{
						$this->name=$name;
						$this->pwd=$pwd;
						$this->email=$email;
						$this->login();
	}
   function login(){
        if($this->name){
        	echo $data=array("code"=>1,"msg"=>"登陆成功");
        }
        echo json_encode($data);
   }　


}

?>