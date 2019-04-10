 
<?php


$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");

$mm=new Memcache();
$mm->connect("127.0.0.1",11211);
$a=$mm->get("zw");
// $mm->flush();
$zw=$_GET['zw'];
if($a==$zw){
	$data1=$pdo->query("select * from `yx` where zw like '%$a%'")->fetchAll();;
	echo "Memcache";
}else{
	$data1=$pdo->query("select * from `yx` where zw like '%$zw%'")->fetchAll();
	$mm->set("zw",$zw);
    echo "mysql";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
	<form action="ss.php">
		职位：<input type="text" name="zw" value="<?php echo $zw?>"><input type="submit" value="搜索">
	</form>
		<table border="1">
		<?php foreach ($data1 as $key => $v) {?>
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

