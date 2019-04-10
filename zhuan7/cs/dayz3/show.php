<?php 
header("Content-type:text/html;charset=utf-8");
$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from ee")->fetchAll();
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
   	<input type="text" name="ms">
   	<input type="submit" value="搜索">
   </form>
	<table>
	<?php foreach ($data as $key => $v) {?>
	   <tr>
			<td><?php echo $v['news'];?></td>
			<td><?php echo $v['ms'];?></td>
		</tr>
	<?php }?>
		
	</table>
</center>
	
</body>
</html>