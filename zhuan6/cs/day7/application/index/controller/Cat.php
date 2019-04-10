<?php
namespace app\index\controller;
use think\Controller;
class Cat extends Controller
{
    public function index()
    {
    	$data=Db('tp_cat')->select();
    	 $cat=getThree($data,0);
    	 dump($cat);
          
    	 $this->assign('cat',$cat);


      return view();
    }
}
