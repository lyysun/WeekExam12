<?php  

$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
 $pdo=new PDO($dsn,"root","root");
  $data=$pdo->query("select * from `weather` ");
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
	
	<td>天气id</td>
	<td>日期</td>
	<td>星期</td>
	<td>城市</td>
	<td>天气状况</td>
	<td>温度</td>
</tr>
<?php foreach ($data as $key => $v) {?>
	<tr>
		<td><?php echo $v['weaid']?></td>
		<td><?php echo $v['days']?></td>
		<td><?php echo $v['week']?></td>
		<td><?php echo $v['citynm']?></td>
		<td><?php echo $v['weather']?></td>
		<td><?php echo $v['temperature']?></td>

	</tr>
<?php }?>
</table>
	
</body>
</html>