<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册用户</title>
</head>
<body>
	<center>
	<form action="<?php echo IUrl::creatUrl("/test/email_add");?>" method="post">
		<table>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="text" name="pwd"></td>
			</tr>
			<tr>
				<td>邮箱</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td><input type="submit" value="注册"></td>
			</tr>
		</table>
		</form>
	</center>
</body>
</html>