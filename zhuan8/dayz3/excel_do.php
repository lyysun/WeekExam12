<?php 
header("content-type:text/html;charset=utf-8");
include_once("Classes/PHPExcel.php");
$file=$_FILES['file'];
echo "<pre>";
// var_dump($file);
$name=$file['name'];
// echo $name;
$tmp_name=$file['tmp_name'];
$img="img/".$name;
move_uploaded_file($tmp_name, $img);

$excel=PHPExcel_IOFactory::load($img);
$data=$excel->getActiveSheet()->toArray();
unset($data[0]);
// var_dump($data);

$pdo=new PDO("mysql:host=127.0.0.1;dbname=2ykyy","root","root");
for ($i=1; $i <=4; $i++) { 
	$user_name=$data[$i][0];
	$word_years=$data[$i][1];
	$job=$data[$i][2];
	$salary=$data[$i][3];
	//数据库添加数据
	$res=$pdo->exec("insert into week3 values('','$user_name','$word_years','$job','$salary')");
}

if($res){
	echo "<a href='show_excel.php'>导入成功</a>";
}
?>