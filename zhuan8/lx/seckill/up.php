<?php 

$id=$_POST['id'];

$redis=new Redis();
$redis->connect("127.0.0.1","6380");

//查询有多少的库存
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from goods where id=$id")->fetch();

//给redis存10值
// for ($i=1; $i <=$data['num'] ; $i++) { 
// 	$redis->lpush("goods".$id,$i);
// }

//判断redis是否删除完

if($redis->lpop("goods".$id)){
      
	$res=$pdo->exec("update goods set num=num-1 where id=$id");
	 if($res){
			$data=array("code"=>1,"msg"=>"抢中");
		}else{
			$data=array("code"=>0,"msg"=>"失败");
		}

}else{
	$data=array("code"=>2,"msg"=>"已售空");
}
echo json_encode($data);

?>