<?php
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";

$pdo=new PDO($dsn,"root","root");
$m=new Memcache();
$m->connect("127.0.0.1",11211);
$a=$m->get('data');
if($a){
	$data=$a;
	echo "m";

}else{
	$data=$pdo->query("select * from `d11.20`")->fetchAll();
	$m->set("data",$data);
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
		<table border="1">
			<?php foreach ($data as $k => $v) {?>
			<tr>
				<td><?php echo $v['id'];?></td>
				<td><?php echo $v['title'];?><a href="showjty.php?id=<?php echo $v['id'];?>">生成静态页</a></td>
				<td><?php echo $v['dz'];?></td>
			</tr>
			<?php }?>
		</table>
	</center>
</body>
</html>