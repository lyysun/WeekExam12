<?php
header("Content-type:text/html;charset=utf-8");
class Server{
      private $name;
      private $s_token="api";
      private $c_token;
      private $time;
      private $mathes;
      private $random;
	function __construct(){
            $this->name=$_GET['name'];
            // var_dump($this->name);die;
            $this->c_token=$_GET['token'];
            $this->time=$_GET['time'];
            $this->mathes=$_GET['mathes'];
            $this->random=$_GET['random'];
            // $this->s_token=md5($this->s_token);
            $this->login();
	}
    function login(){
    	//服务器进行算法处理数居
    	$arr =array(
    		$this->time,
    		$this->random,
    		$this->s_token,
    		 );
    	sort($arr,SORT_STRING);
    	$arr=implode($arr, ',');
    	$math=SHA1($arr);

        if($this->mathes==$math){
              $now=time();
              if($now-$this->time>5){
              	$arr=array("code"=>1,'msg'=>"时间超时");
              }else{
              	// $this->login_do();
                 $arr=array(
    			'code'=>1,
    			'msg'=>"欢迎你".$this->name
    			);
              }
        }else{
        	$arr=array('code'=>0,'msg'=>"no");
        }



    	// if($this->s_token==$this->c_token){
    	// 	$arr=array(
    	// 		'code'=>1,
    	// 		'msg'=>"欢迎你".$this->name
    	// 		);
    	// }else{
    	// 	$arr=array(
    	// 		'code'=>2,
    	// 		'msg'=>"no",
    	// 		);
    	// }

    	echo json_encode($arr);
    }

	
}

new Server();