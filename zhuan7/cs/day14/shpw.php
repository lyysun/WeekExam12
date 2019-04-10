<?php 
$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");


//设置显示上前几页
$p=10;
$offset=0;

//计算总页
$sum=$pdo->query("select * from day14")->rowCount();

//计算总共要几页
$sumye=ceil($sum/$p);
$page=isset($_GET['page'])?$_GET['page']:1;

$prev=$page-1<1?1:$page-1;
$next=$page+1>$sumye?$sumye:$page+1;

//计算偏移量
$offset=($page-1)*$p;

$data=$pdo->query("select * from day14 limit {$offset},{$p}")->fetchALL();

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
	<tr>
		<td>标题</td>
		<td>作者</td>
	</tr>
	<?php foreach ($data as $key => $v) {?>
	<tr>
		<td><?php echo $v['title'];?></td>
		<td><?php echo $v['zz'];?></td>
	</tr>
	<?php }?>

	<a href="./shpw.php?page=1">首页</a>
	<a href="./shpw.php?page=<?php echo $prev;?>">上一页</a>
	<a href="./shpw.php?page=<?php echo $page;?>"><?php echo $page;?></a>
		<a href="./shpw.php?page=<?php echo $next;?>">下一页</a>

</table>
	
</body>
<script type="text/javascript" src="j.js"></script>
<script type="text/javascript">
	
	$(function(){
		$.ajax({
			url:"show.php",
            type:"get",
            success:function(res){
                 console.log(res);
            }
		})
	})
</script>
</html>