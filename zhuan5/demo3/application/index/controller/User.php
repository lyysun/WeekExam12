<?php
namespace app\index\controller;
use app\index\controller\Rbac;
use app\index\model\UserModel;


use think\Request;
use think\Session;


class User extends Rbac
{
    public function index()
    {
       return view('index');

    }

    public function add(){
      $data=Request::instance()->param();
      $a=new UserModel();
      $res=$a->adds($data);
      if($res){
          return $this->success('添加成功','index/User/show');

      }else{
          return $this->error('添加失败');
      }
    }

   public function show(){
        $ccc=Session::get('name');
        $a=new UserModel();
        $data=$a->selects();
        return view('show',['data'=>$data,'name'=>$ccc]);
    }

    function delete(){
        $id=$_GET['id'];
        $a=new UserModel();
        $res=$a->deletes($id);
        // echo $res;die;
        if($res){
            return $this->success('删除成功');

        }else{
            return $this->error('删除失败');
        }
    }

   function update(){//查询一条数据
    $request=Request::instance();
    $id=$request->param('id');
    $user=new UserModel();
    $userinfo=$user->get_one($id);
    $this->assign('userinfo',$userinfo[0]);
    return $this->fetch('update');
   }

   function updatedo(){
    $request=Request::instance();
    $id=$request->param('id');
    // echo $id;die;
    $userName=$request->param('userName');
    // echo $userName;die;
    $user=new UserModel();
    $res=$user->updatedo($id,$userName);
    // echo $res;die;
    if($res>0){
      $this->success('修改成功','index/user/show');
    }else{
      $this->error('修改失败');
    }

   }
  


}
