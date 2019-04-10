<?php 
//开启缓存区
ob_start();
$id=$_GET['id'];
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";

$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from `d11.20` where id=$id")->fetch();
$id=$data['id'];
$title=$data['title'];

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
		<td><?php echo $id;?></td>
		<td><?php echo $title;?></td>
	</tr>
</table>
	
</body>
</html>
<?php 

$ob=ob_get_contents();
file_put_contents("show-{$id}.html",$ob);


?>