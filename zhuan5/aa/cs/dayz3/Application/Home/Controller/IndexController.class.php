<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){//展示
           $Dayz3=M('dayz3');
           if(I('get.time')){
            	$where['time']=I('get.time');
           }
            if(I('get.dlm')){
            	$where['dlm']=I('get.dlm');
           }
           $count=$Dayz3->count();
           // echo $count;die;
           $data=$Dayz3->where($where)->select();
           $this->assign('data',$data);
            $this->assign('count',$count);
           $this->display();
    }

    function add(){//展示添加
    	$this->display('add');
    }

    function insert(){//添加
    	$data=I('post.');
    	$User3=M("user3");
    	$res=$User3->add($data);
    	if($res){
    		$this->success('添加成功',"index");
    	}else{
    		$this->error("添加失败");
    	}
    }

    function delete(){//删除
    	$id=I('get.id');
    	// echo $id;die;
    	$dayz3=M("dayz3");
    	$res=$dayz3->delete($id);
    	// echo $res;die;
    	if($res){
    		$this->success('删除成功');
    	}else{
    		$this->error("删除失败");
    	}
    }
}