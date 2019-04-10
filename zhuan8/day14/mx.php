<?php   
$r=new Redis();
$r->connect("127.0.0.1","6380");

header("content-type:text/html;charset=utf-8");
$id=$_POST['id'];
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from goods where id=$id")->fetch();
$num=$data['num'];


// for ($i=1; $i <=$num ; $i++) { 
// 	$r->lpush("good".$id,$i);
// }
  if($r->lpop("good1")){
           
           $res=$pdo->exec("update goods set num=num-1 where id=$id");
            if($res){
           	$data=array("code"=>1,"msg"=>"抢中");
           }else{
           	$data=array("code"=>0,"msg"=>"失败");
           }


  }else{
  	$data=array("code"=>2,"msg"=>"已空");

  }
  echo json_encode($data);



?>