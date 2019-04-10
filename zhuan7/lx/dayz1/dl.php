<?php 
header("content-type:text/html;charset=utf-8");
$name1=$_GET['name'];
$pwd1=$_GET['pwd'];
$dsn="mysql:host=127.0.0.1;dbname=2yk";
$pdo=new PDO($dsn,"root","root");
$res=$pdo->query("select * from user where name='$name1' and pwd ='$pwd1'")->fetch();

if($res){

	  $dsn="mysql:host=127.0.0.1;dbname=2yk";
	  $pdo=new PDO($dsn,"root","root");
	  $dayz1=$pdo->query("select * from dayz1")->fetchAll();


}else{
	echo "用户名或密码错误";die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<center>
<h3>欢迎<?php echo $name1?></h3>
	<table>
		<tr>
			<td>id</td>
			<td>学号</td>
			<td>年龄</td>
			<td>密码</td>

		</tr>
		<?php foreach ($dayz1 as $key => $v) {?>
		<tr>
			<td><?php echo $v['id']?></td>
			<td><?php echo $v['xh']?></td>
			<td><?php echo $v['age']?></td>
			<td><?php echo $v['pwd']?></td>
		</tr>
		<?php }?>
	</table>
	</center>
</body>
</html>