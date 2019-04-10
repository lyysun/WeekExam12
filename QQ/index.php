<?php 
 header("content-type:text/html;charset=utf-8");

   
	// echo "1";
	if($_GET['code']){
  //1.   

	  $code=$_GET['code'];

        $appid='101353491';			// APPID
        $appkey='df4e46ba7da52f787c6e3336d30526e4';			// APPKEY
        $redirect_uri='http://www.iwebshop.com/index.php';	
        $url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=$appid&client_secret=$appkey&code=$code&redirect_uri=$redirect_uri";
	  $data=file_get_contents($url);
	  $start=strpos($data,"=");
	  $end=strpos($data,"&");
	  $access_token=substr($data, $start+1,$end-$start-1);
           //缓存令牌
            $mm=new Memcache();
            $mm->connect("127.0.0.1","11211");
            $mm->set("access_token",$access_token,0,60*60*12);//赋值
            $a=$mm->get("access_token");//展示

	  // var_dump($access_token);
	  //2.
            $url="https://graph.qq.com/oauth2.0/me?access_token=$access_token";
            $data=file_get_contents($url);
         
            $start=strpos($data, "(");
      	$end=strpos($data, ")");
      	$openidData=substr($data,$start+1,$end-$start-1);
      	$openidData=json_decode($openidData,true);
      	$openid=$openidData['openid'];
       //3.
 
      	$url="https://graph.qq.com/user/get_user_info?access_token=$access_token&oauth_consumer_key=$appid&openid=$openid";
      	$data=file_get_contents($url);
      	$data=json_decode($data,true);
      	$nickname=$data['nickname'];
      	$gender=$data['gender'];
      	$figureurl=$data['figureurl'];
      	echo "你好".$nickname."<img src='$figureurl' alt=''>".$gender;
	 }




?>