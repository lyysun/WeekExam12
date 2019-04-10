<?php
namespace Home\Model;
use Think\Model;
class Day17Model extends Model {
      
      function uploads(){
      	$upload=new \Think\Upload();
      	$upload->rootPath="./Public/";
      	$info=$upload->upload();
      	if($info){
      		$path=$info['images']['savepath'].$info['images']['savename'];
      		return $path;
      	}else{
      		// echo $upload->getError();
      		// return false;
      	}
      }
}