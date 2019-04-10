<?php  
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from moni1")->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>标题</td>
			<td>类型</td>
			<td>作者</td>
		</tr>
		<?php foreach ($data as $key => $v) {?>
			<tr>
				<td><?php echo $v['title'];?></td>
				<td><?php echo $v['lx'];?></td>
				<td><?php echo $v['zz'];?></td>
			</tr>
		<?php }?>
	</table>
</body>
</html>