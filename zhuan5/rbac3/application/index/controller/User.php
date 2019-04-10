<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\UserModel;
use think\Db;
class User extends Rbac
{

	function index(){
		// $data=$this->request->param();
		// dump($data);die;
	   // $userName=$data['userName'];
		// echo $userName;die;
		// $user= new UserModel();
		// $data=$user->getUserList();
		// $this->assign('data',$data);

		// return view('index');
		// 查询状态为1的用户数据 并且每页显示10条数据
		// $list = Db::name('user')->paginate(2);
		// // 把分页数据赋值给模板变量data
		// $this->assign('list', $list);
		// // 渲染模板输出
		 return view();


	}


	function ajax(){
		$data=$this->request->param();
		$uname="";
		if(isset($data['uname']) && !empty($data['uname'])){
			$uname=$data['uname'];
		}
		$user= new UserModel();
		$data=$user->getUserList($uname);
		$link=$data->render();
		// echo $link;die;
		// dumo($link);die;
		$this->assign('link',$link);
		$this->assign('data',$data);
		return view('page');
	}
	function add(){
		$data=$this->request->param();
		// // var_dump($data);die;
		if(!isset($data['userName']) && empty($data['userName'])){
			$this->error('用户不合法','index/user/index');
		}
		$userName=$data['userName'];
		$password=$data['password'];
		$user =new UserModel();
		$res=$user->add($userName,$password);
		if($res>0){
			$this->success('添加成功','index/user/index');
		}else{
			$this->error('添加失败','index/user/index');
		}
     }
      
      function delete(){
      	$data=$this->request->param();
      	$id=$data['id'];
      	$user=new UserModel();
      	$res=$user->deletes($id);
      	if($res>0){
			$this->success('删除成功','index/user/index');
		}else{
			$this->error('删除失败','index/user/index');
		}
      }
      //批删
      function delall(){
	      	$data=$this->request->param();
	      	$ids=$data['ids'];

	      	$user=new UserModel();
	      	$res=$user->del_all($ids);
	      	if($res){
	          echo "删除成功";
	      	}else{
	      	  echo "删除失败";
	      	}
      }
      function update(){
      		$data=$this->request->param();
      	    $id=$data['id'];
      	    // echo $id;die;
      	  	$user= new UserModel();
		    $data=$user->updates($id);
		    // dump($data);die;
		    $this->assign('data',$data[0]);

	     	return view('update');
      }

       function updatedo(){
      	$data=$this->request->param();
      	$id=$data['id'];
      	$user=new UserModel();
      	$res=$user->updatedos($id,$data);
      	if($res){
			$this->success('修改成功','index/user/index');
		}else{
			$this->error('修改失败','index/user/index');
		}
      }
	
}