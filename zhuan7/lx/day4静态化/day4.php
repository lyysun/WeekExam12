<?php 
 
$dsn="mysql:host=127.0.0.1;dbname=2yk";
$user="root";
$pwd="root";
$pdo=new PDO($dsn,$user,$pwd);
$res=$pdo->query("select * from user")->fetchAll();
// var_dump($res);
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<a href="cindexall.php">批量静态化</a>
<table>
	<tr>
		<td>id</td>
		<td>姓名</td>
		<td>密码</td>
		<td>操作</td>
	</tr>
	<?php foreach ($res as $key => $v) {?>
		<tr>
			<td><?php echo $v['id']?></td>
			<td><?php echo $v['name']?></td>
			<td><?php echo $v['pwd']?></td>
			<td><a href="show.php?id=<?php echo $v['id']?>"   id="sum" stu="<?php echo $v['sum']?>" data="<?php echo $v['id']?>">查看</a></td>
			<td><a href="cindex.php?id=<?php echo $v['id']?>">静态化</a>
			<td><a href="javascript:void(0)"  id="sum" stu="<?php echo $v['sum']?>" data="<?php echo $v['id']?>">赞</a>
			 <span>：<?php echo $v['sum']?></span>
			</td>
			</td>

		</tr>
	<?php }?>
</table>
	
</body>
<script type="text/javascript" src="jquery-1.8.3.js"></script>
<script type="text/javascript">
	
	$(function(){
      $("#sum").live("click",function(){
      	
      	id=$(this).attr('data');
    	sum=$(this).attr('stu');
      	  // var a=1;
      		 // alert(sum);
      	 var sum=sum+'+'+'1';
    
      	 $.ajax({
      	 	url:"update.php",
      	 	tyep:'get',
      	 	data:{sum:sum,id:id},
      	 	success:function(res){
              
      	 	}


      	 })
      })
	})
</script>
</html>