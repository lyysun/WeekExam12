<?php 
//使用model层展示数据中的的内容
include("model.php");
// $data=$_POST;

$model=new model();
$res=$model->add("moni2",$data);
if($res){
	echo json_encode(["code"=>1]);die;
}

// $data=$model->update("moni2",['code'=>3,'name'=>'lyy'],1);
// var_dump($data);/
?>