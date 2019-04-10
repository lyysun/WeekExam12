<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\RoleModel;
use think\Session;
use think\Request;
class Role extends Rbac
{
    public function index()
    {
        return view('index');
    }
    function add(){
    	$data=Request::instance()->param();
    	$role=new RoleModel();
    	$res=$role->adds($data);
    	if($res){
    		$this->success('添加成功','index/role/show');
    	}else{
    		$this->error('添加失败');
    	}
    }

    function show(){

            $role=new RoleModel();
            $data=$role->selects();
            $this->assign('role',$data);
            return $this->fetch('show');
    }
    function delete(){
    	$request=Request::instance();
    	$id=$request->param('id');
    	$role=new RoleModel();
    	$res=$role->deletes($id);
    	// echo $res;die;
    	if($res<=0){
    		$this->error('删除失败','/index/role/show');
    	}
    	$this->success('删除成功','/index/role/show');
    }


      function update(){
        $data=Request::instance();
        $roleid=$data->param('id');
        $role=new RoleModel();
        $roleinfo=$role->get_one($roleid);
        $this->assign('data',$roleinfo[0]);
        return view('update');
      }
      function updatedo(){
        $data=Request::instance();
        $roleid=$data->param('id');
        $roleName=$data->param('roleName');
        $role=new RoleModel();
        $res=$role->updatedo($roleid,$roleName);
        if($res>0){
            $this->success('修改成功','index/role/show');
        }else{
            $this->error('修改失败');
        }
      }


    }

