<?php 

include("eb/model.php");
include("model/News.php");

//获取传输的方式
$method = $_SERVER['REQUEST_METHOD'];

// 变化成写
$m=strtolower($method);
//找他对应的方法 {get()};
// var_dump($m);
$m();


//返回的状态值和数据；

function status($data=[],$code=200,$msg=''){

	$arr=[
        'data'=>$data,
        'code'=>$code,
        'msg'=>$msg,

	 ];
    
	echo json_encode(['data'=>$arr]);die;
}


//查询方法
function get(){
      
	  $obj=new News();

      $p=isset($_GET["p"])?$_GET['p']:1;
      $offset=($p-1)*2;

	  $count=$obj->select();
	  $sum=count($count);
	  $sumye=ceil($sum/2);
	   
	  $data=$obj->table("news as n")
	          ->join(" type as t "," n.news_id=t.news_id")
	          ->limit(2,$offset)
	          ->select();
	 //计算总页码
	   $data=[
             "data"=>$data,//显示的数据
             "sumye"=>$sumye,//页码
             // "p"=>$p//第几页
	   ];
	
     status($data); 
}

//添加
function post(){
    
    $data=$_POST;
    // var_dump($data);die;
    $obj=new News();
   $data=$obj->add($data['arr']);
   status($data);
}

//删除
function delete(){

	$data=$_REQUEST;
     $id=$data['id'];
     $obj=new News();
     $res=$obj->where(['id'=>$id])->delete();
     status($res);
}


?>