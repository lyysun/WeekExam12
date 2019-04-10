<?php 

include("Db.php");
//调用Db 公共的方法
$a=Db::getInstance();
$data=$a->show();
var_dump($data);

?>