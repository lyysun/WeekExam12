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
    <a href="jtyall.php">生成静态页</a>
	<table>
	<?php foreach ($data as $key => $v) {?>
		<tr>
			<td><?php echo $v['title'];?></td>
		</tr>
	<?php }?>
	
	</table>
</body>
</html>