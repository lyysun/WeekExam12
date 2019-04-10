<?php

include("../lx/zsgc.php");
$a=new Db();

// $b=$a->insert("insert into news (title) values('111')");

$p=2;

$page=isset($_GET['page'])?$_GET['page']:1;

$sum=$a->show("select * from news");
$sum=count($sum);

$sumye=ceil($sum/$p);


$off=($page-1)*$p;

$b=$a->show("select * from news limit $off,$p");

// ob_start();//开启静态化；
// include("show/show.html");//进入模板
// $ob=ob_get_contents();//只是得到输出缓冲区的内容，但不清除它
// file_put_contents("show-$id.html", $ob);//生成html

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<table border="1">
		<tr>
		<td>标题</td>
		<td>操作</td>
		</tr>
		
		<?php foreach ($b as $key => $value) {?>
		<tr>
		    <td><?php echo $value['title']?></td>
		    <td><a href="jth.php?id=<?php echo $value['id']?>">静态化</a></td>
		  </tr>
		<?php }?>
		

	</table>
	<?php 
      for ($i=1; $i <= $sumye; $i++) { 
      	echo "<a href='zsgc_type.php?page=$i'>$i</a>";
      }
    
   
	?>
</body>
</html>