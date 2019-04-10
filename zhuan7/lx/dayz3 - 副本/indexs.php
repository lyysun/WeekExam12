<?php 
header("Content-type:text/html;charset=utf-8");

$data=curl_init();
curl_setopt($data,CURLOPT_URL,"http://top.17k.com/top/top100/06_vipclick/06_vipclick_serialWithLong_top_100_pc.html");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
$res=curl_exec($data);
// var_dump($res);
$para='#<tr ><td width=".*">.*</td><td width=".*"><a href=".*" target="_blank">(.*)</a></td><td><a class="red" href=".*" title=".*" target="_blank">(.*)</a></td><td><a href=".*" title=".*" target="_blank">(.*)</a></td><td>(.*)</td><td><a href=".*" title=".*" target="_blank">(.*)</a></td><td width=".*">(.*)</td><td>(.*)</td></tr>#isU';
preg_match_all($para,$res,$arr);
echo "<pre>";
// var_dump($arr);
$lx=$arr[1];
$zp=$arr[2];
$zj=$arr[3];
$time=$arr[4];
$zz=$arr[5];
$zt=$arr[6];
$sz=$arr[7];
var_dump($sz);die;
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");

for($i=0;$i<=10;$i++){
	$sql="insert into dayz3 (lx,zp,zj,`time`,zz,zt,sz) values('$lx[$i]','$zp[$i]','$zj[$i]','$time[$i]','$zz[$i]','$zt[$i]','$sz[$i]')";
    $pdo->exec($sql);
}

echo '<a href="show.php">添加成功</a>';
?>