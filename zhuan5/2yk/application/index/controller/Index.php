<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\controller\Rbac;
class Index extends Rbac
{
    public function index()
    {     

    	 $session=Session::get();
    	 $name=$session['name'];
    	 $this->assign("name",$name);
    	 dump($session);
         $arr=Db('node')->select();
         $data=node($arr);
         $this->assign('data',$data);
         return view();
    }
}
