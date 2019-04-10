<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
     $this->display('add');
    }
    function insert(){
    	$data=I('get.');
    	// echo $data;
    	$Day6=M('day6');
    	$res=$Day6->add($data);
    	if($res){
    		$this->success('添加成功');
    	}else{
    		$this->error('添加失败');
    	}
    }

    function show(){
    	$Day6=M('day6');
    	$data=$Day6->select($data);
    	$this->assign('data',$data);
    	$this->display();
    }
}