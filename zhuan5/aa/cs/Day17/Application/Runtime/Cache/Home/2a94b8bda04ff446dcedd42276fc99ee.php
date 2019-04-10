<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/aa/cs/Day17/index.php/Home/Index/add" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>图片</td>
				<td><input type="file" name="images"></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
	<table>
		<tr>
			<td>图片</td>
		</tr>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><img src="/aa/cs/Day17/Public/<?php echo ($vo["images"]); ?>"  width="100" height="100" alt=""></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
</body>
</html>