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
<form action="<?=Url::to(['day3/add'])?>" method="post">
	留言：<input type="text" name="name">
	<input type="submit" value="提交">
	</form>
</body>
</html>