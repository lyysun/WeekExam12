<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
        function index(){
        	$catList=Db("tp_cat")->where("is_show=1")->select();
        	$cat=getThree($catList,0);
        	$flag=1;
        	$this->assign('cat',$cat);
        	$this->assign('flag',$flag);
        	return view();
        }
}