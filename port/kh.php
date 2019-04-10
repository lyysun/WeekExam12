
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/kh.php" method="get">
	<input type="text" name="msg">
	<input type="submit" value="发送">
</form>
</body>
</html>


<?php
header("Content-type:text/html;charset=utf-8");

$msg=isset($_GET['msg'])?$_GET['msg']:'';
// echo $msg;die;
 if($msg==''){
 	echo "请输入你要想问的 ! !";die;
 }

$url="http://api.qingyunke.com/api.php?key=free&appid=0&msg=$msg";
// var_dump($url);die;
$data=file_get_contents($url);
// var_dump($data);die;
$data=json_decode($data,true);
// var_dump($data['content']);
$data=$data['content'];
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php echo $data?>
</body>
</html>
