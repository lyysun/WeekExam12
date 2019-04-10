<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php  echo $path = "www.abc.com/a.php?id=1".'<br>'; $str=substr_replace("www.abc.com/a.php?id=1",'abc.com', $path); echo $str ?>

</body>
</html>