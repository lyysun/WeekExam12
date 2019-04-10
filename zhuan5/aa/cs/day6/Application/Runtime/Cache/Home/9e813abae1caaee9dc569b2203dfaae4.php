<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/aa/cs/index.php/Home/Index/insert" method="get">
		<table>
			<tr>
				<td>核心</td>
				<td><input type="text" name="hx"></td>
			</tr>
			<tr>
				<td>选择器</td>
				<td><input type="text" name="xzq"></td>
			</tr>
			<tr>
				<td>ajax</td>
				<td><input type="text" name="ajax"></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
</body>
</html>