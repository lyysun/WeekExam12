<?php 

header("content-type:text/html;charset=utf-8");
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from goods")->fetchAll();


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
		<th>名称</th>
		<th>个数</th>
		<th>操作</th>
	</tr>
	<?php foreach ($data as $key => $value) {?>
		<tr>
			<td><?php echo $value['name']?></td>
			<td><?php echo $value['num']?></td>
			<td><input type="button" id="mx" value="秒杀" data="<?php echo $value['id']?>"></td>
		</tr>
	<?php }?>
</table>
</body>
<script type="text/javascript" src="jq.js"></script>
<script type="text/javascript">
	$("#mx").click(function(){
		id=$(this).attr("data");
		$.ajax({
			url:"mx.php",
			type:"post",
			dataType:"json",
			data:{id:id},
			success:function(res){
                 alert(res.msg);
                 location.reload();
			}
		})
	})
</script>
</html>