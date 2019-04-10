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
	<center>
	<h1>添加页面</h1>
		<form action="<?=Url::to(['xiao2/add'])?>" method="post">
			<tr>
				<td>姓名: <input type="text" name="name">	</td>
			</tr><br>

			<tr>
				<td>年龄: <input type="text" name="age">	</td>
			</tr><br>
			
			<tr>
			<td>性别: </td>
				<td><input type="radio" name="sex" value="男">男<input type="radio" name="sex" value="女">女	</td>

			</tr><br>
			<tr>
				<td><input type="submit" value="添加"></td>
			</tr>
		</form>
	</center>
</body>
</html>