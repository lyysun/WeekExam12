<?php 
$name=$_GET['name'];
$news=$_GET['news'];
// var_dump($news);die;
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,'root','root');
$res=$pdo->query("insert into day7 (name,news) values('$name','$news')");


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
		<td>标题</td>
	</tr>
</table>
	

</body>
</html>