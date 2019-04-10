<?php
namespace app\index\controller;
use  app\index\controller\Rbac;
use  app\index\model\RoleModel;

use  app\index\model\NodeModel;

class Rolenode extends Rbac
{
	function index(){
		$data=$this->request->param();//接收参数
		if(!isset($data['roleId'])||empty($data['roleId'])){
            $this->error('缺少参数');
		}
		$roleId=$data['roleId'];
		//查询所有权限
		$node=new NodeModel();
		$list=$node->selects();
		//查询所有角色权限id
        $role=new RoleModel();
        $nodeIds=$role->getNodeIdsByRoleId($roleId);
        // dump($nodeIds);die;
        $this->assign('roleId',$roleId);
        $this->assign('nodeIds',$nodeIds);
        $this->assign('list',$list);
		return view();
	}

	function add(){
         $data=$this->request->param();
         // dump($data);die;
         $roleId=$data['roleId'];
         // dump($roleId);die;
         $nodeIds= array_merge($data['nodePids'],$data['nodeIds']);
         // dump($nodeIds);die;
         if(empty($nodeIds)){
         	$this->error('权限不能为空');
         }

        
        
         $role=new RoleModel();
         // dump($role);die;
         $res= $role->addRoleNode($roleId,$nodeIds);
        // echo $res;die;
        if(!$res){
        	$this->success('添加权限失败',"index/role/index");
        }else{
        	$this->error('添加权限成功','index/role/index');
        }


	}
}