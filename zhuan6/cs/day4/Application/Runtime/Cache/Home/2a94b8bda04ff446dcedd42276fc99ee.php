<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<center>
<h3>展示</h3>
<table border="1" >
       <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
       		<td> <input type="text" id="xg" data="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["wz"]); ?>"></td>
       		<td><?php echo ($vo["fy"]); ?></td>
       		<td><?php echo ($vo["mj"]); ?></td>
       		<td><?php echo ($vo["jmj"]); ?></td>
       		<td><?php echo ($vo["fx"]); ?></td>
       		<td><?php echo ($vo["jz"]); ?></td>
       		<td><?php echo ($vo["xz"]); ?></td>
       		<td><?php echo ($vo["zt"]); ?></td>
       		<td><button id="del" data="<?php echo ($vo["id"]); ?>">删除</button></td>
       	</tr><?php endforeach; endif; ?>
</table>
	</center>
</body>
<script type="text/javascript" src="/zhuan6/cs/day4/Public/js/jquery-1.8.3.js"></script>
<script type="text/javascript">
	$("#del").live('click',function(){
		// alert(1)
		id=$(this).attr('data');
		// alert(id)
	      _this=$(this);
		$.ajax({
			url:"/zhuan6/cs/day4/index.php/Home/Index/del",
			type:"get",
			data:{id:id},
			success:function(res){
                  alert("是否删除");
                  
                  	_this.parent().parent().remove();
                
			}
		})
	})

	$("#xg").live('blur',function(){
		// alert(1)
		id=$(this).attr('data');
		alert(id)
	
		$.ajax({
			url:"/zhuan6/cs/day4/index.php/Home/Index/del",
			type:"get",
			data:{id:id},
			success:function(res){
                  alert("是否删除");
                  
                  	_this.parent().parent().remove();
                
			}
		})
	})
</script>
</html>