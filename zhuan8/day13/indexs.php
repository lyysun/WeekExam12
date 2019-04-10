<?php 
session_start();
$ip=$_SERVER["REMOTE_ADDR"];

$_SESSION['q']=$ip;

header("content-type:text/html;charset=utf-8");
$file=$_FILES['file'];

// var_dump($file);
include_once("Classes/PHPExcel.php");
$name=$file['name'];
$tmp_name=$file['tmp_name'];
$destination="img/".$name;
move_uploaded_file($tmp_name, $destination);
$excel=PHPExcel_IOFactory::load($destination);
$data=$excel->getActiveSheet()->toArray();
echo "<pre>";
// delete($data[0]);
var_dump($data);

$dsn="mysql:host=127.0.0.1;dbname=yk";
$pdo=new PDO($dsn,"root","root");

foreach ($data as $key => $v) {
	  $userName=$v[0];
	  $password=$v[1];
	  $sql="insert into `user` (userName,password) values ('$userName','$password')";
	  $pdo->exec($sql);

}

?>