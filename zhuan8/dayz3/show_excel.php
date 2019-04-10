<?php 
//展示数据
header("content-type:text/html;charset=utf-8");
$pdo=new PDO("mysql:host=127.0.0.1;dbname=2ykyy","root","root");
$data=$pdo->query("select * from week3")->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
	<p>信息展示</p>
		<table>
			<tr>
				<th>姓名</th>
				<th>工龄</th>
				<th>职位</th>
				<th>月资</th>
			</tr>
			<?php foreach ($data as $key => $v) {?>
			<tr>
				<td><?php echo $v['user_name']?></td>
				<td><?php echo $v['word_years']?></td>
				<td><?php echo $v['job']?></td>
				<td><?php echo $v['salary']?></td>
			</tr>
			<?php }?>
		</table>
	</center>
</body>
</html>