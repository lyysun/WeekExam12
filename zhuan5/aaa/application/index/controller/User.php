<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\UserModel;
/**
 * 首页
 */
class User extends Rbac
{
    //首页信息展示(用户总数|角色总数|权限总数)
    public function index()
    {
    	$user=new UserModel;
    	$data=$user->getUserList();
    	$this->assign('data',$data);
        return view('index');
    }
    public function add(){
    	//接受参数
    	$post=$this->request->post();
    	$userName=$post['userName'];
    	$password=$post['password'];
    	//判断参数是否合法
    	if(empty($userName)){
    		$this->error('用户名不能为空','/index/user/index');
    	}
    	if(empty($password)){
    		$this->error('密码不能为空','/index/user/index');
    	}
    	//这里进行插入数据
    	$user=new UserModel;
    	$rows=$user->addUser($userName,$password);
    	if($rows<=0){
    		$this->error('插入失败','/index/user/index');
    	}
    	$this->success('插入成功','/index/user/index');
    }
    public function delete($uid){
    	$param=$this->request->param();
    	$uid=$param['uid'];
    	if(empty($uid)){
    		$this->error('用户Id不能为空','/index/user/index');
    	}
    	$user=new UserModel;
    	$rows=$user->delUser($uid);
    	if($rows<=0){
    		$this->error('删除失败','/index/user/index');
    	}
    	$this->success('删除成功','/index/user/index');
    }
    public function update($uid){
    	$param=$this->request->param();
    	$uid=$param['uid'];
    	if(empty($uid)){
    		$this->error('用户Id不能为空','/index/user/index');
    	}
    	$user=new UserModel;
    	$userInfo=$user->getUserInfo($uid);
    	$this->assign('userInfo',$userInfo[0]);
    	return view('update');
    }
    public function doUpdate(){
    	$post=$this->request->post();
    	$uid=$post['uid'];
    	$userName=$post['userName'];
    	//判断参数是否合法
    	if(empty($uid)){
    		$this->error('用户Id不能为空','/index/user/index');
    	}
    	if(empty($userName)){
    		$this->error('用户名不能为空','/index/user/index');
    	}
    	$user=new UserModel;
    	$rows=$user->updateUser($uid,$userName);
    	if($rows<=0){
    		$this->error('修改失败','/index/user/index');
    	}
    	$this->success('修改成功','/index/user/index');
    }
    public function userRole(){
        
        $uid=$this->request->post('uid');
        $roleId=$this->request->post('roleId');
        // if(empty($uid)){
        //     $this->error('未知用户','/index/user/index');
        // }
        // if(empty($roleId)){
        //     $this->error('未知角色','/index/user/index');
        // }
        $user=new UserModel();
        $id=$user->addUserRole($uid,$roleId);
        if($id<=0){
            $this->error('分配角色失败','/index/user/index');
        }
        $this->success('分配角色成功','/index/user/index');
    }
}
