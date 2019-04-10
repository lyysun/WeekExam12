<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\NodeModel;
use think\Request;
class Node extends Rbac
{
    public function index()
    {
       return view('index');
    }


    function add(){
    	$data=$this->request->param();
    	// echo $data;die;
    	$node=new NodeModel();
    	$res=$node->add($data);
    	if($res){
    		$this->success('添加成功','index/node/show');
    	}else{
    		$this->error('添加失败','index/node/index');
    	}
    }


    function show(){
    	$node=new NodeModel();
    	$data=$node->select();
    	// var_dump($data);die;
    	$this->assign('data',$data);
    	return $this->fetch('show');
    }

    function delete(){
    	$id=Request::instance()->param('id');
    	// echo $id;die;
    	$node=new NodeModel();
    	// echo $node;die;
    	$res=$node->deletes($id);
    // echo $res;die;
	     $data=$node->select();
	     $this->assign('data',$data);
    	return $this->fetch('ajax');

    }
}