<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Type extends Controller
{
      function index(){
      	$data=Db('tp_type')->select();
      	foreach ($data as $key => $v) {
      		 $where["type_id"]=$v['type_id'];
                   $data[$key]['num']=Db('tp_attr')->where($where)->count();
      		 if($v['is_show']==1){
      		 	$data[$key]['is_show']='<img src="images/yes.gif">';
      		 }else{
      		 	$data[$key]['is_show']='<img src="images/no.gif">';
      		 }
      	}
      	$this->assign('data',$data);
      	return view();
      }
      function add(){


      	return view();
      }
      function insert(){
      	$data=input('post.');
      	$res=Db('tp_type')->insert($data);
      	if($res){
      		$this->success('添加成功');
      	}
      }
}