<?php
namespace Home\Model;
use Think\Model;
class Day13Model extends Model {

	function adds($data){
		$Day13=M("day13");
		$res=$Day13->add($data);
		return $res;
	}

	function uploads(){
		$upload=new \Think\Upload();
		$upload->rootPath="./Public/Uploads/";
		$info=$upload->upload();
		if($info){
			$path=$info['images']['savepath'].$info['images']['savename'];
			return $path;
		}
	}

}