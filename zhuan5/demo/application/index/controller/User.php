<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use think\Request;
use app\index\model\UserModel;
//首页
class User extends Rbac
{
	//添加用户页面
    public function index()
    {
    	return view('index');
    }
    //添加用户入库
    public function add(){
    	$request=Request::instance();
    	$userName=$request->post('userName');
    	$password=$request->post('password');
    	if(empty($userName)){
    		$this->error('用户名不能为空','/index/user/index');
    	}
    	if(empty($password)){
    		$this->error('密码不能为空','/index/user/index');
    	}
    	$user=new UserModel();
    	$id=$user->addUser($userName,$password);
    	if($id<=0){
    		$this->error('添加用户失败','/index/user/index');
    	}
    	$this->success('添加用户成功','/index/user/showList');
    }
    //显示用户列表
    public function showList(){
    	$user=new UserModel();
    	$data=$user->getUserList();
    	$this->assign('users',$data);
    	return $this->fetch('showList');
    }
    //删除用户
    public function delete(){
    	$request=Request::instance();
    	$uid=$request->param('uid');
    	$user=new UserModel();
    	$row=$user->deleteUserByUid($uid);
    	if($row<=0){
    		$this->error('删除失败','/index/user/showList');
    	}
    	$this->success('删除成功','/index/user/showList');
    }
    //修改用户页面
    public function update(){
    	$request=Request::instance();
    	$uid=$request->param('uid');
    	$user=new UserModel();
    	$userInfo=$user->getUserInfoByUid($uid);
    	$this->assign('userInfo',$userInfo[0]);
    	return $this->fetch('update');
    }
    //修改用户入库
    public function doupdate(){
    	$request=Request::instance();
    	$uid=$request->param('uid');
    	$userName=$request->param('userName');
    	$user=new UserModel();
    	$rows=$user->updateUserNameByUid($uid,$userName);
    	if($rows<=0){
    		$this->error('修改失败','/index/user/showList');
    	}
    	$this->success('修改成功','/index/user/showList');
    }
    public function userRole(){
        $request=Request::instance();
        $uid=$request->post('uid');
        $roleId=$request->post('roleId');
        if(empty($uid)){
            $this->error('未知用户','/index/user/showList');
        }
        if(empty($roleId)){
            $this->error('未知角色','/index/user/showList');
        }
        $user=new UserModel();
        $id=$user->addUserRole($uid,$roleId);
        if($id<=0){
            $this->error('分配角色失败','/index/user/showList');
        }
        $this->success('分配角色成功','/index/user/showList');
    }
}
