<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\GoodsModel;
class Goods extends Controller
{
       function index(){
       	$a=new GoodsModel();
        $data=$a->select();
        $page=$data->render();
        $this->assign('page',$page);
       $this->assign('data',$data);
       	return view();
       }
         function ajax(){
       	$a=new GoodsModel();
        $data=$a->select();
        $page=$data->render();
        $this->assign('page',$page);
       $this->assign('data',$data);
       	return view();
       }

       function xg(){
       	$data=input('get.');
       	// dump($data);die;
       	$id=$data['id'];
       	// dump($id);die;
       	$name=$data['name'];
       	$data['cat_name']=$name;
       	$a=Db('tp_cat')->where("cat_id=$id")->update($data);
         // echo  $a;die;
       
       }
}