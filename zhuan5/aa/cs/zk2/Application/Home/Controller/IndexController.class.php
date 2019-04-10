<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       
      $this->display('add');
    }
    function insert(){//添家页
    	$data=I('post.');
    	$Zk2=M('zk2');
    	$res=$Zk2->add($data);
    	if($res){
    		$this->success('添加成功','show');
    	}else{
    		$this->error('添加失败');
    	}
    }

    function show(){//展示页
    	$Zk2=M('zk2');
    	$data=$Zk2->select();
    	$this->assign("data",$data);
    	$this->display();
    }

    function delete(){//删除页
    	$id=I('get.id');
        $Zk2=M('zk2');
    	$res=$Zk2->delete($id);
    	if($res){
    		$this->success('删除成功');
    	}else{
    		$this->error('删除失败');
    	}
    }

      function del_all(){
      	$id=I('get.id');
        $Zk2=M('zk2');
    	$res=$Zk2->where("id in($id)")->delete();
    	$data=$Zk2->select();
    	$this->assign("data",$data);
    	$this->display('ajax');

      }
}