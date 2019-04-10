<?php 

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
	<?php foreach ($data as $key => $v) {?>
	       	<?php echo $v['num']?>
	        <input type="button" value="秒杀" id="mx" data="<?php echo $v['id']?>">
	<?php }?>
</body>
<script type="text/javascript" src="jq.js"></script>
<script type="text/javascript">
	
	$("#mx").click(function(){
       id=$(this).attr("data");
        $.ajax({
        	url:"up.php",
        	type:"post",
        	dataType:"json",
        	data:{id:id},
        	success:function(res){
                 alert(res.msg);
                 //加载页面
                 location.reload();
        	}
        })
	})
</script>
</html>
