<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>id</td>
			<td>标题</td>
			<td>分类</td>
			<td>作者</td>
			<td>图片</td>
			<td>时间</td>
			<td>造作</td>
		</tr>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($vo["id"]); ?></td>
			<td><?php echo ($vo["bt"]); ?></td>
			<td><?php echo ($vo["fl"]); ?></td>
			<td><?php echo ($vo["zz"]); ?></td>
			<td><img src="/aa/cs/day14/Public/<?php echo ($vo["images"]); ?>" alt="" width="100px" height="100"></td>
			<td><?php echo (date("Y-m-d",time()))?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<?php echo ($page); ?>
</body>
</html>