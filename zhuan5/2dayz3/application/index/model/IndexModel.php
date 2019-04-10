<?php
namespace app\index\model;
use think\Model;
use think\Session;
class IndexModel extends Model
{
       function selects(){
       	$sql="select * from 2dayz3";
       	$data=$this->query($sql);
       	$arr=[];
       	foreach ($data as $v) {
       		  if($v['pid']==0){
       		  	$key=$v['id'];
                $arr[$key]=$v;
       		  }else{
       		     $key=$v['pid'];
                $arr[$key]['chlid'][]=$v;
       		  }
       	}
       	return $arr;

       }

       function sel(){
       	$sql="select * from 2dayz3_1";
       	$data=$this->query($sql);
       	$arr=[];
       	foreach ($data as $v) {
       		  if($v['pid']==0){
       		  	$key=$v['id'];
                $arr[$key]=$v;
       		  }else{
       		     $key=$v['pid'];
                $arr[$key]['chlid'][]=$v;
       		  }
       	}
       	return $arr;

       }
}