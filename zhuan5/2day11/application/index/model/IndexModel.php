<?php
namespace app\index\model;
use think\Model;

class Index extends Model
{
	function selects(){
		  $sql="select * from 2day11";
        return $this->query($sql);
	}
}