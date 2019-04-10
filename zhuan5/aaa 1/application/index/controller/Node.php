<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\NodeModel;
/**
 * 首页
 */
class node extends Rbac
{
    //首页信息展示(用户总数|角色总数|权限总数)
    public function index()
    {

        $roleId=$this->request->param('roleId');
    	$node=new NodeModel;
    	$data=$node->getNodeList();
        $this->assign('nodes',$data);
        if(!empty($roleId)){
            $nodeIds=$node->getNodeIdsByRoleId($roleId);
            $this->assign('nodeIds',$nodeIds);
            $this->assign('roleId',$roleId);
        }
    	return view('index');
    }
    public function delete(){
        $nodeId=$this->request->param('nodeId');
        $node=new NodeModel;
        $rows=$node->deleteNodeById($nodeId);
        if($rows<=0){
            $this->error('删除失败','/index/node/index');
        }
        $this->success('删除成功','/index/node/index');
    }
    //添加角色入库
    public function add(){
        $param=$this->request->param();
        $nodeName=$param['nodeName'];
        $nodeDes=$param['nodeDes'];
        $pid=$param['pid'];
        if(empty($nodeName)){
            $this->error('权限名称不能为空','/index/node/index');
        }
        if(empty($nodeDes)){
            $this->error('权限描述名称不能为空','/index/node/index');
        }
        if($pid<0 || !is_numeric($pid)){
            $this->error('权限父级id不正确','/index/node/index');
        }
        //入库操作
        $node=new NodeModel();
        $id=$node->addNode($nodeName,$nodeDes,$pid);
        if($id<=0){
            $this->error('添加权限失败','/index/node/index');
        }
        $this->error('添加权限成功','/index/node/index');
    }
    
    public function ajaxUpdate(){
        $param=$this->request->param();
        if(empty($param)){
            echo json_encode(array('status'=>1,'message'=>'参数不能为空'));
            die;
        }
        if(empty($param['nodeId'])){
            echo json_encode(array('status'=>2,'message'=>'nodeId不能为空'));
            die;
        }
        if(empty($param['nodeDes'])){
            echo json_encode(array('status'=>3,'message'=>'nodeDes不能为空'));
            die;
        }
        $node=new NodeModel();
        $row=$node->updateNodeById($param['nodeId'],$param['nodeDes']);
        if($row<=0){
            echo json_encode(array('status'=>4,'message'=>'修改失败'));
            die;
        }
        echo json_encode(array('status'=>0,'message'=>'修改成功'));
        die;
    }
}
