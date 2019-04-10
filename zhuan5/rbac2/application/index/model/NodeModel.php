<?php
namespace app\index\Model;
use think\Model;
use think\Db;
class NodeModel extends Model
{
    function add($data){
		return Db::table('node')->insert($data);
	}
    function select(){
		return Db::table('node')->select();
	}

	function deletes($id){
		return Db::table('node')->where("id",$id)->delete();
	}
    
    function selectnode(){
    	$sql="select * from node";
    	$data=$this->query($sql);
    	$arr=array();
    	if (isset($data)&& !empty($data)) {
    		foreach ($data as $item) {
    			if($item['pid']==0){
    				$key=$item['id'];
    				$arr[$key]=$item;
    			}else{
    				$key=$item['pid'];
    				if(isset($arr[$key])){
    					$arr[$key]['child'][]=$item;
    				}
    			}
    		}
    		return $arr;
    	
    	}
    }

}