<?php

header("Content-type:text/html;charset=utf-8");
$name="李园园";
$pwd="123456";
$token="api";

// $token=md5($token);
$time=time();
$random=rand(1000,9999);
//客户端进行算法处理
$arr=array($time,$token,$random);
sort($arr,SORT_STRING);//进行排序
$arr=implode($arr, ',');
$mathes=SHA1($arr);//sha1加密

$url="http://www.port.com/server.php?name=$name&token=$token&time=$time&random=$random&mathes=$mathes&pwd=$pwd";

// echo $url;die;
$data=file_get_contents($url);
// var_dump($data);die;
$data=json_decode($data,true);
var_dump($data);
?>