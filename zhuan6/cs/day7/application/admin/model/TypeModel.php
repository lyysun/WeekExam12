<?php
namespace app\admin\model;
use think\Model;
class TypeModel extends Model
{           
	   public $size=2;
         function select(){
         	$sql="select count(*) as count from tp_type";
         	$data=$this->query($sql);
         	$count=$data[0]['count'];
         	$list=Db('tp_type')->paginate($this->size,$count);
         	return $list;
         }
}