<?php
namespace app\index\controller;
use  app\index\controller\Rbac;
use  app\index\model\NodeModel;

class Node extends Rbac
{
	function index(){
         $node=new NodeModel();

		$data=$node->selects();
		$this->assign('data',$data);
		return view('index');
	}

	function add(){
		$data=$this->request->param();
		$pid=0;
		if(isset($data['pid']) && !empty($data['pid'])){
			// $this->error('权限pid不合法','/index/node/index');
			$pid=$data['pid'];
		}
		if(!isset($data['nodeName']) || empty($data['nodeName'])){
			$this->error('名称不合法','/index/node/index');
		}
		if(!isset($data['nodeDes']) || empty($data['nodeDes'])){
			$this->error('描述不合法','/index/node/index');
		}
	        // $pid=$data['pid'];
	        $nodeName=$data['nodeName'];
         $nodeDes=$data['nodeDes'];
         $node=new NodeModel();
         $res=$node->adds($pid,$nodeName,$nodeDes);
         if($res>0){
         	$this->success('添加成功','index/node/index');
         }else{
         	$this->error('添加失败','index/node/index');
         }

	}
   
 
}