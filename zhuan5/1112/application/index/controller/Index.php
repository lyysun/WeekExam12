<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        $data=Db::table('2day1')->select();
        // dump($data);die;
        $this->assign('data',$data);
        return $this->fetch();
    }
}
