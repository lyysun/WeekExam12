<?php 
header("Content-type:text/html;charset=gb2312");
$data=curl_init();
curl_setopt($data,CURLOPT_URL,"http://www.4399.com/");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);//设置返回值形式
curl_setopt($data,CURLOPT_SSL_VERIFYPEER,0);
$res=curl_exec($data);
// var_dump($res);
$para='#<li><a href=".*" onclick=".*"><em><img src=".*" /></em>(.*)</a></li>#isU';
preg_match_all($para,$res,$arr);
echo "<pre>";
print_r($arr[1]);
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
  $pdo=new PDO($dsn,"root","root");
foreach ($arr as $key => $v) {
	// print_r($v);
	$name=$arr[1][$key];
	
     $sql="insert into day7 (name) values('$name')";
     $res=$pdo->exec($sql);
}


?>