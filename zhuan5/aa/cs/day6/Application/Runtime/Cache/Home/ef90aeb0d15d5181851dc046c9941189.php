<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<table border="1">
	<tr>
		<td>核心</td>
		<td>选择器</td>
		<td>ajax</td>
	</tr>
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><a href="/aa/cs/index.php/Home/Index/hx/show"><?php echo ($vo["hx"]); ?></a></td>
			<td><?php echo ($vo["xzq"]); ?></td>
			<td><?php echo ($vo["ajax"]); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
	
</body>
</html>