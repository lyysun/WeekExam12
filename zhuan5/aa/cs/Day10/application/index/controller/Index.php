<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    {
       return view('add');
     
    }

    function dd(){
    	$this->error('你没有访问的权限');
    }

    function dz(){
        
          $data= Db::table('day6hx')->select();
          $this->assign('data',$data);
          return $this->fetch('show');
         // dump($res);
    }
}
