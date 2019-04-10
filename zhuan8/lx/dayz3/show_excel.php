<?php 


$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from dayz3")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<center>
<p>信息展示</p>
<table>
	<tr>
		<th>名称</th>
		<th>年龄</th>
		<th>职位</th>
		<th>工资</th>
	</tr>
	<?php foreach ($data as $key => $v) {?>
		<tr>
			<td><?php echo $v['name']?></td>
			<td><?php echo $v['age']?></td>
			<td><?php echo $v['zw']?></td>
			<td><?php echo $v['m']?></td>
		</tr>
	<?php }?>
</table>
	</center>
</body>
</html>