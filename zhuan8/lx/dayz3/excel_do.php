<?php  
header("content-type:text/html;charset=utf-8");
include_once("Classes/PHPExcel.php");
$file=$_FILES['file'];
echo "<pre>";
$name=$file['name'];
$tmp_name=$file['tmp_name'];

$img="img/".$name;
move_uploaded_file($tmp_name,$img);
$excel=PHPExcel_IOFactory::load($img);
$data=$excel->getActiveSheet()->toArray();
unset($data[0]);
// var_dump($data);



$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");

for ($i=1; $i <=4; $i++) { 
	$name=$data[$i][0];
	$age=$data[$i][1];
	$zw=$data[$i][2];
	$m=$data[$i][3];
    
    $res=$pdo->exec("insert into dayz3 values('','$name','$age','$zw',$m)");


}
if($res){
	echo "<a href='show_excel.php'>添加成功</a>";
}
?>