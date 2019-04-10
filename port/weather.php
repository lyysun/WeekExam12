
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="weather.php" method="get">
	<input type="text" name="weather">
	<input type="submit" value="搜索">
	</form>
</body>
</html>

<?php
 header("content-type:text/html;charset=utf-8");
 $weaid=isset($_GET['weather'])?$_GET['weather']:'';

$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
 $pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from `weather` where citynm='$weaid'")->fetch();
// $data=json_decode($data,true);
 echo "<pre>";
$a=$data['citynm'];
 if($weaid==''){
 	echo "请输入天气 ！ ！";die;
 }

 if($weaid==$a){
          echo '<a href="weather_list.php">查看天气</a>';
	}else
	{
		
	$appkey="10003";//密码

	$sign="b59bc3ef6191eb9f747dd4e83c99f2a4";

	 $url="http://api.k780.com:88/?app=weather.future&weaid=$weaid&appkey=$appkey&sign=$sign&format=json";
	 // var_dump($url);die;
	 $data=file_get_contents($url);
	 $data=json_decode($data,true);
	 echo "<pre>";
	 // var_dump($data['result']);
	 $citynm=$data['result'][0]['citynm'];


	 
 



		 for($i=0;$i<1;$i++){
		 	    $weaid=$data['result'][$i]['weaid'];
		        $days=$data['result'][$i]['days'];
		        $week=$data['result'][$i]['week'];
		        $citynm=$data['result'][$i]['citynm'];
		        $temperature=$data['result'][$i]['temperature'];
		        $weather=$data['result'][$i]['weather'];
		      $sql="insert into `weather` (weaid,days,week,citynm,weather,temperature) values ('$weaid','$days','$week','$citynm','$weather','$temperature')";
		       // echo $sql;die;
		      $pdo->exec($sql);

		 }
		  echo '<a href="weather_list.php">查看天气</a>';

	}



?>