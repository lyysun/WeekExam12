<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\NodeModel;
class Node extends Rbac
{
    public function index()
    {
       $node=new NodeModel();
        $data=$node->select();
        // dump($data);die;
        $this->assign('data',$data);
        return view('index');
    }

   
}