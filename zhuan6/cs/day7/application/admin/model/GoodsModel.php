<?php
namespace app\admin\model;
use think\Model;
class GoodsModel extends Model
{
	 public $size=5;
     function select(){
     	$sql="select count(*) as count from tp_cat";
     	$data= $this->query($sql);
     	$count=$data[0]['count'];
     	$list=Db('tp_cat')->paginate($this->size,$count);
     	return $list;
     }

    }