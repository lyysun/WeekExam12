<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Controller;
use app\index\model\NodeModel;

class RoleNode extends Rbac
{
       function index(){
       	$data=$this->request->param();
       	// dump($data);die;
              $roleId=$data['roleId'];
       	$node=new NodeModel();
       	$data=$node->selectnode();
       	$role=new RoleModel();
       	$nodeIds=$role->noderoleId($roleId);
       	 $this->assign('roleId',$roleId);
              $this->assign('nodeIds',$nodeIds);
       	$this->assign('data',$data);
       	return view();

       }

       function add(){
       	$data=$this->request->param();
       	$roleId=$data['roleId'];
       	$nodeIds=array_merge($data['nodePids'],$data['nodeIds']);
       	$role=new RoleModel();
       	$res=$role->addRoleNode($roleId,$nodeId);
       	if($res){
       		$this->success('添加成功')
       	}
       }
}