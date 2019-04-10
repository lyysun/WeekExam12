<?php 

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from day7")->fetchAll();


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
			<td>作者</td>
		</tr>
		<?php foreach ($data as $key => $v) {?>
		<tr>
			<td><?php echo $v['news']?></td>
			<td><?php echo $v['name']?></td>
			<td><a href="jth.php?id=<?php echo $v['id']?>">静态化</a></td>
		</tr>
		<?php }?>
	</table>
</body>
</html>