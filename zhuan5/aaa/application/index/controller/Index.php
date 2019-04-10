<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\UserModel;
use app\index\model\RoleModel;
use app\index\model\NodeModel;
/**
 * 首页控制器
 */
class Index extends Rbac
{
    public function index()
    {
    	$user=new UserModel();
    	$userCount=$user->getUserCount();
    	$this->assign('userCount',$userCount[0]['count']);
    	$role=new RoleModel();
    	$roleCount=$role->getRoleCount();
    	$this->assign('roleCount',$roleCount[0]['count']);
    	$node=new NodeModel();
    	$nodeCount=$node->getNodeCount();
    	$this->assign('nodeCount',$nodeCount[0]['count']);
    	return view('index');
    }
}
