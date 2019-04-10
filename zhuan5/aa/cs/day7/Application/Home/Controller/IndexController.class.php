<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $this->display('add');
    }
    function insert(){
    	$data=I('get.');
    	$Day8=M('day8');
    	$res=$Day8->add($data);
    	if($res){
    		$this->success('添加成功');
    	}else{
    		$this->display('添加失败');
    	}
    }
}