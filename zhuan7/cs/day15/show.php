<?php 

$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from day14")->fetchALL();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<table>
<?php foreach ($data as $key => $v) {?>
	<tr>
		<td><img src="<?php echo $v['title'];?>" width="150" height="95" ></td>
	</tr>
<?php }?>
	
</table>
	
</body>
</html>