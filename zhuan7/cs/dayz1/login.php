<?php
$name1=$_POST['name'];
$pwd1=$_POST['pwd'];

 $dsn="mysql:host=127.0.0.1;dbname=zhuan7";
 $pdo=new PDO($dsn,"root","root");
 $res=$pdo->query("select * from dayz1 where name='$name1' and pwd='$pwd1'")->fetch();
 // echo $res;
if($res){

     $_SESSION_start;
     
     


     $dsn="mysql:host=127.0.0.1;dbname=zhuan7";
	 $pdo=new PDO($dsn,"root","root");
	 $data=$pdo->query("select * from user")->fetchAll();


}else{
	echo "error";die;
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
		<a href="add.html">注册信息</a>
	<table>
		<tr>
			<td>学号</td>
			<td>年龄</td>
			<td>电话</td>
		</tr>
		<?php foreach ($data as $k => $v) {?>
			<tr>
				<td><?php echo $v['xh']?></td>
				<td><?php echo $v['age']?></td>
				<td><?php echo $v['tel']?></td>
			</tr>
		<?php }?>
	</table>
	</center>

</body>
</html>