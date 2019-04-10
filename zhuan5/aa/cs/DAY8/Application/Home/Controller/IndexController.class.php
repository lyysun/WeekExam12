<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$Day8=M('day8');
    	if(I('get.id')){
    		$where['id']=I('get.id');
    	}
    	$p=isset($_GET['p'])?$_GET['p']:1;
    	$data=$Day8->where($where)->page("$p,2")->select();
    	$count=$Day8->count();
    	$Page=new \Think\Page($count,2);
    	$show=$Page->show();
    	$this->assign('data',$data);
    	$this->assign('page',$show);
        $this->display('add');
    }
}