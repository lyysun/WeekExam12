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
        // dump($session);die
        $name=$session['name'];
        $this->assign("name",$name);
        if($session['name']=="admin"){
             return view('root');
         }else{
         	return view('admin');
         }
       
    }

    function shownode(){
         $session=Session::get();

         $name=$session['name'];
          // dump($name);die;
         $this->assign("name",$name);
         $arr=Db('node')->select();
         $a=nodedg($arr);
         $this->assign('a',$a);
         return view();
    }
}
