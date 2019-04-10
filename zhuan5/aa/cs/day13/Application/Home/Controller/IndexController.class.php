<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      $this->display('add');
    }


    function insert(){
    	$data=I('post.');
    	$Day13=D('day13');
    	$images=$Day13->uploads();
    	if($images){
    		$data['images']=$images;
    	}

    	$res=$Day13->adds($data);
    	if($res){
    		$this->success('添加成功');
    	}else{
    		$this->error('添加失败');
    	}
    }
}