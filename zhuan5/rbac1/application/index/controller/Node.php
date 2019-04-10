<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\NodeModel;
use think\Request;
class Node extends Rbac
{       
	function index(){
	
        $request=Request::instance();
        $roleId=$request->param('roleId');
    	$node=new NodeModel();
    	$data=$node->selects();
        $this->assign('nodes',$data);
        if(!empty($roleId)){
            $nodeIds=$node->getNodeIdsByRoleId($roleId);
            $this->assign('nodeIds',$noedIds);
            $this->assign('roleId',$roleId);
        }
     
    	
    	return view('show');
    }

}