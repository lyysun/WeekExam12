<?php 
header("Content-type:text/html;charset=utf-8");
$data=curl_init();
curl_setopt($data,CURLOPT_URL,"https://m.zhaopin.com/beijing-530/?keyword=php&order=0&maprange=3&ishome=0");
curl_setopt($data,CURLOPT_RETURNTRANSFER,1);
curl_setopt($data,CURLOPT_SSL_VERIFYPEER,0);
$res=curl_exec($data);
$para1='#<div class="job-name fl ">(.*)</div>#isU';
preg_match_all($para1,$res,$arr1);
echo "<pre>";
// var_dump($arr1[1]);
$title=$arr1[1];

$para2='#<span class="ads">(.*)</span>#isU';
preg_match_all($para2,$res,$arr2);
echo "<pre>";
// var_dump($arr2[1]);
$dz=$arr2[1];

$para3='#<div class="comp-name fl">(.*)</div>#isU';
preg_match_all($para3,$res,$arr3);
echo "<pre>";
// var_dump($arr3[1]);
$gs=$arr3[1];

$para4='# <div class="fl">(.*)</div>#isU';
preg_match_all($para4,$res,$arr4);
echo "<pre>";
// var_dump($arr4[1]);
$m=$arr4[1];

$para5='#<div class="time fr">(.*)</div>#isU';
preg_match_all($para5,$res,$arr5);
echo "<pre>";
// var_dump($arr5[1]);
$tm=$arr5[1];


$dsn="mysql:host=127.0.0.1;dbname=zhuan7";

$pdo=new PDO($dsn,"root","root");

for($i=0;$i<5;$i++){
    

    $sql="insert into `d11.20` (title,dz,gs,m,tm) values(?,?,?,?,?)";
    $a=$pdo->prepare($sql);//预处理
    $a->bindValue(1,$title[$i]);
    $a->bindValue(2,$dz[$i]);
    $a->bindValue(3,$gs[$i]);
    $a->bindValue(4,$m[$i]);
    $a->bindValue(5,$tm[$i]);
    $a->execute();
}
echo '<a href="list.php">success</a>;'

?>