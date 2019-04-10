<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h3>用户添加列表</h3>
	<form action="/aa/cs/dayz3/index.php/Home/Index/insert" method="post">
		<table>
			<tr><td>用户名称</td>
			<td><input type="text" name="user"></td>
			</tr>
			<tr><td>用户密码</td>
			<td><input type="text" name="pwd"></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
</body>
</html>