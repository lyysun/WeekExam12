<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/aa/cs/day13/index.php/Home/Index/insert" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>文章标题</td>
				<td><input type="text" name="bt"></td>
			</tr>
			<tr>
				<td>文章分类</td>
				<td><select name="fl" id="">
					<option value="经典小说">经典小说</option>
				</select></td>
			</tr>
			<tr>
				<td>文章作者</td>
				<td><input type="text" name="zz"></td>
			</tr>
			<tr>
				<td>文章封面</td>
				<td><input type="file" name="images"></td>
			</tr>
			<tr>
				<td>文章内容</td>
				<td><textarea name="nr" id="" cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" value="确认添加"></td>
			</tr>
		</table>
	</form>
</body>
</html>