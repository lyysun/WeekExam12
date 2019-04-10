<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

    	$Day17=M('day17');
    	$data=$Day17->select();
    	$this->assign('data',$data);
       $this->display();
    }

    // function add(){
    // 	$upload = new \Think\Upload();// 实例化上传类
    // 	$upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录
    // 	$info   =   $upload->upload();
    // 	if(!$info) {// 
    // 		 $this->error($upload->getError());
    // 		  }else{// 上传成功
    // 		  	 $this->success('上传成功！');   
    // 		  	  }
    // }

    function add(){
    	$data=I('post.');
    	// dump($data);die;
    	$Day17=D('day17');
    	$images=$Day17->uploads();
    	// echo $images;die;
    	if($images){
    		$data['images']=$images;
    	}
    	$res=$Day17->add($data);
    	if($res){
    		$this->success('添加成功','index');
    	}else{
    		$this->error('添加失败');
    	}
    }


}