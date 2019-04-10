<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="<?php echo IUrl::creatUrl("/test/eamil_login_add");?>" method="post">
	用户名<input type="text" name="name">
	密码<input type="text" name="pwd">
	<input type="submit" value="登陆">
</form>
	
</body>
</html>