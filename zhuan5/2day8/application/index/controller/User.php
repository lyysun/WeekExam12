<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\IndexModel;
class User extends Controller
{
	function index(){
		// $data=$this->request->param();
		// $page=$data['page'];
		$page=$_GET['page'];
		// echo $page;die;
		$offset=($page-1)*2;//偏移量

		$data=Db::table('2day7') ->limit($offset,2)->select();
		$this->assign('data',$data);

        $json=json_encode($data);    //json 数据
	    $this->assign('json',$json);
          // dump($json);die;
        $count=Db::table('2day7')->count();//计算总条数
		$sum=ceil($count/2);
    	$this->assign('page',$sum);//分页展示
 
   
        return view();

	}
	function load(){
		$data=Db::table('2day7')->limit(2)->select();
		$this->assign('data',$data);//展示数据

		$count=Db('2day7')->count();
		$sum=ceil($count/2);
		$this->assign('page',$sum);//分页展示

		return view();
	}
}