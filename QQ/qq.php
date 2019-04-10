<?php 


     header("content-type:text/html;charset=utf-8");
     $appid='101353491';			// APPID
	 $appkey='df4e46ba7da52f787c6e3336d30526e4';			// APPKEY
	 $redirect_uri='http://www.iwebshop.com/index.php';		// 回调地址
	 $state=rand(1000,9999);
	 $url="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=$appid&redirect_uri=$redirect_uri&state=$state";
     header("location:$url");

?>