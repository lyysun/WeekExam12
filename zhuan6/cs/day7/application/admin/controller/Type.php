<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\TypeModel;
class Type extends Controller
{
         function index(){
                   $a=new TypeModel();
                   $data=$a->select();
                   $page=$data->render();
                   $this->assign('data',$data);
                   $this->assign('page',$page);
         	        return view();
         }

              
              function ajax(){
                 $a=new TypeModel();
                   $data=$a->select();
                   $page=$data->render();
                   $this->assign('data',$data);
                   $this->assign('page',$page);
                  return view();
              }


          function add(){
         	return view();
         }
          function insert(){

         $data=input('post.');
         $res=Db('tp_type')->insert($data);
         if($res){
         	$this->success('添加成功',url('index'));
         }
         dump($data);
         }
}