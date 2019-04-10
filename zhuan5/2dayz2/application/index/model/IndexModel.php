<?php
namespace app\index\model;
use think\Db;
use think\Model;
class IndexModel extends Model
{
     function selects($name){
     	$sql="select * from staff where s_name like '%$name%'";
     	// echo $sql;
     	return $this->query($sql);
     }
     function xgs($id,$name){
     	$sql="update staff set s_name='$name' where s_id='$id'";
     	// echo $sql;die;
     	return $this->query($sql);


     }
     function dels($id){
           $sql="delete * from staff where s_id='$id'";
           return $this->query($sql);

     }
     
}