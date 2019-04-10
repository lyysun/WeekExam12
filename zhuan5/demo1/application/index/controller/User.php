<?php
namespace app\index\controller;
use app\index\model\Rbac;
use app\index\model\UserModel;
use think\Controller;

use think\Request;
use think\Session;

class User extends Controller
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
        if($res){
            return $this->success('删除成功');

        }else{
            return $this->error('删除失败');
        }
    }
    function update(){
        $id=$_GET['id'];
        return view("update",['id'=>$id]);
    }
    function updatedo(){
        $date=Request::instance()->param();
        $id=$date['id'];
        $arr['userName']=$date['userName'];
        $arr['password']=$date['password'];
        $a=new UserModel();
        $res=$a->update($id,$arr);
        if($res){
            $this->success('添加成功','index/User/show');
        }else{
            $this->error('添加失败');
        }

    }


}
