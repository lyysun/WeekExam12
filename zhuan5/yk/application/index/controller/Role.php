<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\RoleModel;
class Role extends Rbac
{
    public function index()
    {
         return view();
    }

    function select(){
    	$role=new RoleModel();
    	$data=$role->select();
    	// dump($data);die;
    	$this->assign('data',$data);
    	return view('index');

    }
}