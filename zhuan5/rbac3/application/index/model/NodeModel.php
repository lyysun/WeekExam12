<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class NodeModel extends Model
{
	function adds($pid,$nodeName,$nodeDes){
		$sql="insert into node (pid,nodeName,nodeDes) values('$pid','$nodeName','$nodeDes')";
		return $this->query($sql);
	}

	function selects(){
		$sql="select * from node";
		$data= $this->query($sql);
		// dump($data);die;
		$tempArr=array();
		if(isset($data) && !empty($data)){
              foreach ($data as $item) {
                       if($item['pid']==0){
                       	$key=$item['id'];
                       	$tempArr[$key]=$item;
                       }else{
                       	$key=$item['pid'];
                       	if(isset($tempArr[$key])){
                            $tempArr[$key]['child'][]=$item;

                       	}
                       }
              }
		}
		// dump($tempArr);
           return $tempArr;
		
	}
}