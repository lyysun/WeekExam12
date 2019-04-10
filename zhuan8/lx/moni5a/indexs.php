<?php 

header("content-type:text/html;charset=utf-8");
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
// $sum=$pdo->query("select * from dayz3 d inner join class c on d.class_id=c.class_id inner join addr a on c.addr_id=a.addr_id")->fetchAll();
 echo "<pre>";
 // var_dump($sum);die;
 $p=5;
 $sum=$pdo->query("select * from dayz3 d inner join class c on d.class_id=c.class_id inner join addr a on c.addr_id=a.addr_id")->rowCount();


 $sumye=ceil($sum/$p);
 $page=isset($_GET['page'])?$_GET['page']:1;
 $prev=$page-1<1?1:$page-1;
 $next=$page+1>$sumye?$sumye:$page+1;
 $offset=($page-1)*$p;

$data=$pdo->query("select * from dayz3 d inner join class c on d.class_id=c.class_id inner join addr a on c.addr_id=a.addr_id limit {$offset},{$p}")->fetchAll();
// var_dump($data);die;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<center>
<p>信息展示</p>
<table>
	<tr>
		<th>名称</th>
		<th>年龄</th>
		<th>职位</th>
		<th>工资</th>
	</tr>
	<?php foreach ($data as $key => $v) {?>
		<tr>
			<td><?php echo $v['name']?></td>
			<td><?php echo $v['age']?></td>
			<td><?php echo $v['zw']?></td>
			<td><?php echo $v['m']?></td>
			<td><a href="xq.php?id=<?php echo $v['id']?>">详情</a></td>
		</tr>
	<?php }?>

</table>
<a href="./indexs.php?page=<?php echo $prev?>">上一页</a>
<a href="./indexs.php?page=<?php echo $next?>">下一页</a>

	</center>
</body>
</html>