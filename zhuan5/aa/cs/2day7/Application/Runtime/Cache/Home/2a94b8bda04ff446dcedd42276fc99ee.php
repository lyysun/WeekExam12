<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="/aa/cs/2day7/index.php/Home/Index/index" method="get">
名称<input type="text" name="uname">
<input type="submit" value="搜索">
	
</form>
	<table border="1">
		<tr>
			<td><input type="checkbox"></td>
			<td>编号</td>
			<td>新闻名称</td>
			<td>添加日期</td>
			<td>是否发布</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><input type="checkbox"></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo (date('Y-m-d',time()))?></td>
				<td><?php echo ($vo["fb"]); ?></td>
				<td><button>发布</button></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<?php echo ($page); ?>
</body>
</html>