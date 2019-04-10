<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $day7=M('2day7');
        if(Ighj7('get.uname')){
        	$where['name']=I('get.uname');
        }
        $p=isset($_GET['p'])?$_GET['p']:1;
        $data=$day7->page($p,'2')->where($where)->select();
        // echo $data;die;
        $count=$day7->count();
        $Page=new \Think\Page($count,2);
        $show=$Page->show();
        $this->assign('page',$show);
        $this->assign('data',$data);

        $this->display();
    }
}