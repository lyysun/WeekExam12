<?php


$dsn="mysql:host=127.0.0.1;dbname=zhuan7";
$pdo=new PDO($dsn,"root","root");

$mm=new Memcache();//实力化memcache;
$mm->connect("127.0.0.1",11211);//链接

  

$a=$mm->get('zp');//取出 zp 判断memcache里是否有缓存 zp 赋值给$a;

$zp=$_GET['zp'];  
if($a==$zp){

	     $data=$pdo->query("select * from dayz3 where zp like '%$zp%'")->fetchAll();;
	       echo "memcache";
    }else{

		$data=$pdo->query("select * from dayz3 where zp like '%$zp%'")->fetchAll();
	    $mm->set('zp',$zp);//缓存memcahe;
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
		作品：<input type="text" name="zp" value="<?php echo $_GET['zp'];?>" >
		<input type="submit" value="搜索">
	</form>
		<table border="1">
			<tr>
				<td>排名</td>
					<td>类别</td>
						<td>作品</td>
							<td>最新章节</td>
								<td>更新时间</td>
									<td>作者</td>
										<td>状态</td>
											<td>榜单数值</td>

			</tr>
			<?php foreach ($data as $key => $v) {?>
				<tr>
					<td><?php echo $v['id'];?></td>
					<td><?php echo $v['lx'];?></td>
					<td><?php echo $v['zp'];?></td>
					<td><?php echo $v['zj'];?></td>
					<td><?php echo $v['time'];?></td>
					<td><?php echo $v['zz'];?></td>
					<td><?php echo $v['zt'];?></td>
					<td><?php echo $v['sz'];?></td>

				</tr>
			<?php }?>
		</table>
	</center>
</body>
</html>