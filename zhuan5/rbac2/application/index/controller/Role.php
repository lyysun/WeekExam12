<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\RoleModel;
use think\Request;
class Role extends Rbac
{
    public function index()
    {
        $role=new RoleModel();
        $data=$role->select();
        // var_dump($data);die;
        $this->assign('data',$data);
       return view('index');
    }

    function add(){
    	$data=$this->request->param();
    	$role=new RoleModel();
    	$res=$role->add($data);
    	if($res){
    		$this->success('添加成功','index/role/index');
    	}else{
    		$this->error('添加失败','index/role/index');
    	}
    }

    function delete(){
        $id=Request::instance()->param('id');
        $role=new RoleModel();
        $res=$role->deletes($id);
        if($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

      public function addUserRole($uid,$roleId){//添加用户角色
        $sql="delete from userRole where userId={$uid}";
        $this->query($sql);
        $sql="insert into userRole(userId,roleId) values('$uid','$roleId')";
        $this->execute($sql);
        $sql="select last_insert_id()";
        $id=$this->query($sql);
        return $id;
    }


}