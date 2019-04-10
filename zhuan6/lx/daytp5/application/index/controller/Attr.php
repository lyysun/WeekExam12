<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Attr extends Controller
{
          function index(){
          	$type_id=input('type_id');
          	$where['type_id']=$type_id;
          	$attrList=Db('tp_attr')->where($where)->select();
           
           foreach ($attrList as $key => $val) {
                  if($val['attr_input_type']==0){

                  	$attrList[$key]['attr_input_type']='手工录入';
                  }else if($val['attr_input_type']==1){
                  	$attrList[$key]['attr_input_type']='从下面的列表中选择（一行代表一个可选值）';
                  }else{
                  	$attrList[$key]['attr_input_type']='多行文本';
                  }
           }
           $this->assign('type_id',$type_id);
           $this->assign('attrList',$attrList);
          	return view();
          }
          function add(){

             $type_id=input('type_id');
             $typeList=Db('tp_type')->select();
             $this->assign('typeList',$typeList);
             $this->assign('type_id',$type_id);
           	return view();
         
          }
          function insert(){


          	$data=input('post.');
          	// dump($data);die;
          	$type_id=$data['type_id'];
          	$res=Db('tp_attr')->insert($data);
          	if($res){
          		$this->success('添加成功',url('index',['type_id'=>$type_id]));
          	}else{
          	$this->error('添加失败');
          	}
          }
          
           public function getAttr(){
        $type_id = input('type_id');
        $where['type_id'] = $type_id;
        $attrList = Db::name('tp_attr')->where($where)->select();
        foreach ($attrList as $key => $val) {
            if($val['attr_input_type']!=0){
              $attrList[$key]['attr_values'] =   explode("\r\n",$val['attr_values']);
            }
        }
       
        $this->assign('attrList',$attrList);
        return view();
        
    }

}