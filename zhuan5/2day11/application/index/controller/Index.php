<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\IndexModel;
use think\Db;
class Index extends Controller
{
    public function index()
    {
         $data=Db::table('2day11')->select();
         $this->assign('data',$data);
         return view();
    }
}
