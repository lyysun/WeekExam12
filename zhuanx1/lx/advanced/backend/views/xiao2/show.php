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
<table>
	 <tr>
		<td>姓名</td>
		<td>年龄</td>
		<td>性别</td>
		<td>时间</td>
	</tr>
<?php foreach ($data as $key => $value) {?>
	<tr>
		<td><?=$value['name']?></td>
		<td><?=$value['age']?></td>
		<td><?=$value['sex']?></td>
		
		<td><?php echo date("Y-m-d",$value['time'])?></td>
		<td><a href="<?=Url::to(['xiao2/del','id'=>$value['id']])?>">删除</a>||
		<a href="<?=Url::to(['xiao2/update_show','id'=>$value['id']])?>">修改</a></td>
	</tr>
	
<?php }?>
</table>
    
	
</body>
</html>