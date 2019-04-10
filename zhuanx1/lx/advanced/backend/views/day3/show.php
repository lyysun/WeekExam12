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
<form action="<?=Url::to(['day3/show'])?>" method="post">
	<input type="text" name="name"><input type="submit" value="搜索">
</form>
	<table border="1">
		<tr>
			<th>详情</th>
			<th>操作</th>
		</tr>
		<?php foreach ($data as $key => $value): ?>
			<tr>
				<td><?=$value['name']?></td>
				<td><a href="<?=Url::to(['day3/del','id'=>$value['id']])?>">删除</a></td>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>