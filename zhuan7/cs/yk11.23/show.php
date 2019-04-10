<?php
$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from `yx`")->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
	<form action="ss.php" method="get">
		职位：<input type="text" name="zw"><input type="submit" value="搜索">
	</form>
	<a href="jth.php">静态化</a>
		<table border="1">
		<?php foreach ($data as $key => $v) {?>
			<tr>
				<td><?php echo $v['zw']?></td>
				<td><?php echo $v['name']?></td>
				<td><?php echo $v['zd']?></td>
				<td><?php echo $v['m']?></td>
				<td><?php echo $v['time']?></td>


			</tr>
		<?php }?>
			
		</table>
	</center>
</body>
</html>