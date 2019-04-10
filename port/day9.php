<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="day9.php" method="get">
   <input type="text" name="name">
   <input type="submit" value="提交">
	</form>
</body>
</html>
<?php
$name=isset($_GET['name'])?$_GET['name']:'';
if ($name=='') {
echo "请输入姓名";die;
}

$url="http://www.port.com/day9f.php?name=$name";
$data=file_get_contents($url);
// var_dump($data);die;
$data=json_decode($data,true);
var_dump($data);
?>