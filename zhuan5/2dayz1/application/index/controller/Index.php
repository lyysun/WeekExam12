<?php
namespace app\index\controller;
use think\Controller;

use think\Db;
class Index extends Controller
{
    public function index()
    {
       return view();
    }

     function dl(){
     	// $data=$this->request->param();
     	// // dump($data);die;
     	// $data=
     	$data['name']=$_POST['name'];
     	$data['pwd']=$_POST['pwd'];
     	$res=Db::table('2dayz1')->where($data)->select();
     	if($res){
     		echo "Yes";
     	}else{
     		echo "No";
     	}
     }

     function role()
     {
     	return view();
     }

     function addrole(){
     	$data=$this->request->param();
     	// dump($data);
     	$res=Db::table('2dayz1_role')->insert($data);
     	// echo $res;""
         if($res){
         	$this->success('添加成功','/index/index/show');
         }
     }

     function show(){
     	$data=Db::table('2dayz1_role')->select();
     	$this->assign('data',$data);
     	return view();
     }
}
