<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h3>注册</h3>
<form action="<?=Url::to(['day3/add'])?>" method="post">
	<table>
		<tr>
			<td>用户名：<input type="text" name="name"></td>
		</tr>
		<tr>
			<td>密码：<input type="text" name="pwd"></td>
		</tr>
		<tr>
			<td><input type="submit" value="登陆"></td>
		</tr>
	</table>
</form>
	
</body>
</html>