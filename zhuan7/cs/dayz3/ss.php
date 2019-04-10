<?php
$dsn="mysql:host=127.0.0.1;dbname=234";
$pdo=new PDO($dsn,"root","root");

$mm=new Memcache();
$mm->connect("127.0.0.1",11211);


$a=$mm->get('ms');

$ms=$_GET['ms'];
if($a==$ms){
         $data=$pdo->query("select * from ee where `ms` like '%$a%'")->fetchAll();

      echo "MeMcache";
}else{
	 $data=$pdo->query("select * from ee where `ms` like '%$ms%'")->fetchAll();
      $mm->set('ms',$ms);
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

   <form action="ss.php" method="get">
   	<input type="text" name="news">
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