<?php
header("Content-type:text/html;charset=utf-8");
include("QL/phpQuery.php");//in如文件
include("QL/QueryList.php");//in如文件
$url = 'http://dianying.114la.com/?kz';//创建地址
// var_dump($url);
//找出需要的数据
$rules=array(
       "urls"=>array(".liSy2 ul li a","href"),
       "title"=>array(".td h2","text"),
       "f"=>array(".liSy2 ul li a span b","text"), 
	);

//调用静态方法
$q=\QL\QueryList::Query($url,$rules);
echo "<pre>";

//过去data数据
$res=$q->getData();


$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
foreach ($res as $key => $v) {
	 if(!empty($v['urls'])){
	 	$urls=$v['urls'];
	 };
	 
	  if(!empty($v['title'])){
	 	$title=$v['title'];
	   };

	  if(!empty($v['f'])){
	  	$f=$v['f'];
		 $sql="insert into `d11.19` (`urls`,`title`,`f`) values('$urls','$title','$f')";
		 $pdo->exec($sql);
	   };	
	
	
    
	
	 
}


?>