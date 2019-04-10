<?php 
header("content-type:text/html;charset=utf-8");

$r=new Redis();
$r->connect("127.0.0.1","6380");
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");

$name=$_POST['name'];
$pwd=$_POST['pwd'];
$tel=$_POST['tel'];
$time=date("Y-m-d");
$code=$_POST['code'];//传过来的验证码

$rcode=$r->get("code");//缓存里面取得
if($rcode){//判断是否过期
       if($rcode==$code){//判断是否相等
           $sql="insert into moni6 values('','$name','$pwd','$tel','1','$time')";
           $res=$pdo->exec($sql);
           if($res){
           	$data=array("code"=>2,"msg"=>"注册成功");
           }


       }else{
       	$data=array("code"=>1,"msg"=>"验证码，不一致");
       }


}else{
	$data=array("code"=>0,"msg"=>"验证码，过期");
}

echo json_encode($data);


?>