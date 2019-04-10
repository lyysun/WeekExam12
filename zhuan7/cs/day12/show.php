<?php
header("Content-type:text/html;charset=utf-8");
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");

//这只显示几条数据
$p=2;
$offset=0;

//计算总条数
$sum=$pdo->query("select * from day7")->rowCount();

//计算总页码
$sumye=ceil($sum/$p);
$page=isset($_GET['page'])?$_GET['page']:1;


$prev=$page-1<1?1:$page-1;
$next=$page+1>$sumye?$sumye:$page+1;

//计算变异量
$offset=($page-1)*$p;

$data=$pdo->query("select * from day7 limit {$offset},{$p}")->fetchAll();
echo "<pre>";
// print_r($data);

$c=new Memcache();
$c->connect("127.0.0.1",11211);
$c->set('list',$data);
// $c->delete("k3");
 // $c->replace("k2","44");
 $s=$c->get("list");
var_dump($s);

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
		<td>姓名</td>
		<td>邮箱</td>
		<td>新闻</td>
	</tr>
	<?php foreach ($data as $key => $v) {?>
		<tr>
			<td><?php echo $v['name'];?></td>
			<td><?php echo $v['email'];?></td>
			<td><?php echo $v['news'];?></td>
		</tr>
	<?php }?>
	<a href="./show.php?page=1">首页</a>
	<a href="./show.php?page=<?php echo $prev?>">上一页</a>
	<a href="./show.php?page=<?php echo $page?>"><?php echo $page?></a>
	<a href="./show.php?page=<?php echo $next?>">下一页</a>
</table>
	
</body>
</html>