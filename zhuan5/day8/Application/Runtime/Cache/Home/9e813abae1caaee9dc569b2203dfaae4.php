<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/Public/jquery-1.8.3.js"></script>
</head>
<body>
	<form action="/index.php/Home/Index/insert" method="get">
		<table>
			<tr>
				<td>分类名称</td>
				<td><input type="text" name="nm" id="nm"></td>
			</tr>
			<tr>
				
				<td>启用状态</td>
				<td>
				<input type="radio" name="stats" value="是">是
				<input type="radio" name="stats" value="否">否
			</td></tr>
			<tr>
				<td>分类描述</td>
				<td><textarea name="ms" id="" cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td><input type="submit"  value="确认添加"></td>
			</tr>

		</table>
	</form>
</body>
<script type="text/javascript">
	$('#id').blur(function(){
       alert(111);
	});
</script>
</html>