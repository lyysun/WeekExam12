<?php 
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from day14")->fetchALL();
// var_dump($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<table>
        <?php foreach ($data as $key => $va) {?>
        	<tr><td><img src="<?php echo $va['title'];?>" width="200px" height="200px"></td></tr>
        <?php }?>
		
	</table>
</body>
</html>