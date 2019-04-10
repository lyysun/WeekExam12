<?php
namespace app\index\model;
use app\index\controller\Rbac;
use think\Controller;
use think\Model;
use think\Db;
class UserModel extends Model
	{ 
		 private $size=2;
		function select($name){
			$sql="select count(*) as count from user where userName like '%$name%'";
			$data=$this->query($sql);
			$count=$data[0]['count'];
			$map['userName']  = ['like',"%$name%"];
           // 查询状态为1的用户数据 并且每页显示10条数据
           $list = Db::name('user')->where($map)->paginate($this->size,$count);
           // dump($list);die;
           return $list;
			
		}
		function status($id,$status){
               $sql="update user set status='$status' where id='$id'";
               return $this->query($sql);
		}

		function delall($ids){
			$ids=implode(',',$ids);
			$sql="delete from user where id in($ids)";
			return $this->query($sql);
		}

	}