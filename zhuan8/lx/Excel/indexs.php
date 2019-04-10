<?php  
include_once("Classes/PHPExcel.php");
$file=$_FILES['file'];
// var_dump($file);die;
echo "<pre>";
$tmp_name=$file['tmp_name'];
// var_dump($tmp_name);die;

$name=$file['name'];
 //设置路径
$img="img/".$name;
//移动上传文件 必需。规定要移动的文件   必需。规定文件的新位置
move_uploaded_file($tmp_name,$img);
//加载路径
$excel=PHPExcel_IOFactory::load($img);
//将Excel文件变成一个数组
$data=$excel->getActiveSheet()->toArray();
var_dump($data);

?>