

<?php 

$weaid=$_POST['weather'];

header("content-type:text/html;charset=utf-8");
$url="http://api.k780.com:88/?app=weather.future&weaid=$weaid&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,  CURLOPT_RETURNTRANSFER,1);
$data=curl_exec($ch);
$data=json_decode($data,true);
$data=$data['result'];
// var_dump($data);
echo json_encode($data);

















// $week=array();
// $c=array();
// // $cc=array();
// foreach ($arr as $v) {
// 	$week[]="'".$v['week']."'";
//     $c[]="[".$v['temperature']."]";
//   }

// $week=implode($week,",");
// $c=implode($c,",");
// $cc=str_replace("/",",",$c);//截取替换 你要替换谁 换成什么  字符串

// // $ccc=str_replace("℃","",$cc);//截取替换 你要替换谁 换成什么  字符串
// // echo $ccc;die;

// $ccc = preg_replace('/℃/','',$cc);  //去掉你不想要的字符
// $ccc="[".$ccc."]";
// echo json_encode($ccc);



?>

