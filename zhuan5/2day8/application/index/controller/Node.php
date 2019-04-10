<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\IndexModel;
class Node extends Controller
{
	function index(){
		$arr=Db('2day7_type')->select();
		$a=node($arr);
		$this->assign('a',$a);
		return view('index');
	}
}