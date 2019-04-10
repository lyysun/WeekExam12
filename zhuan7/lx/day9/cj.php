<?php 
header("Content-type:text/html;charset=gb2312");
//初始化数据
$data=curl_init();
//数据传输
curl_setopt($data,CURLOPT_URL,"http://www.4399.com/");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
//揭开安全
curl_setopt($data,CURLOPT_SSL_VERIFYPEER,0);
//运行

$res=curl_exec($data);

$para='#<li><a href=".*"><img alt="(.*)" src=".*">(.*)</a></li>#isU';
preg_match_all($para,$res,$arr);
echo "<pre>";
var_dump($arr[1]);
?>