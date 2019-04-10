<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\NodeModel;
use app\index\model\RoleModel;

class Rolenode extends Rbac{
        function index(){
        	$data=$this->request->param();
        	// dump($data);
        	
        	$roleId=$data['roleId'];
               // echo $roleId;die;
        	$node=new NodeModel();
        	$data=$node->selectnode();
        	$role=new RoleModel();
        	$nodeIds=$role->rolenodeid($roleId);

        	$this->assign('nodeIds',$nodeIds);
        	$this->assign('roleId',$roleId);
        	$this->assign('data',$data);
        	return view();
        }

        function add(){
        	$data=$this->request->param();
        	$roleId=$data['roleId'];
        	$nodeIds=array_merge($data['nodePids'],$data['nodeIds']);
        	$role=new RoleModel();
        	$res=$role->addrolenode($roleId,$nodeIds);
        	if($res){
        		$this->success("添加成功",'index/role/index');
        	}else{
        		$this->error("添加失败");
        	}
        }
}