<?php 
$id=$_GET['id'];
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");

$res=$pdo->exec("update dayz3 set num=num+1 where id=$id");

$data=$pdo->query("select * from dayz3 where id=$id")->fetch();
// var_dump($data);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<tr>
			<td>浏览次数<?php echo $data['num']?></td>
		</tr>
	</table>
</body>
</html>