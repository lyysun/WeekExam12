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

        $roleId=$this->request->param('roleId');//查询角色的id
    	$node=new NodeModel;
    	$data=$node->getNodeList();//使用
        $this->assign('nodes',$data);
        if(!empty($roleId)){
            $nodeIds=$node->getNodeIdsByRoleId($roleId);//5表联查//如果选中查看时默认选中
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
