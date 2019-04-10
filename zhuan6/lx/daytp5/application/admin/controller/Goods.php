<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Goods extends Controller
{
       function index(){
       	//查询商品信息
       	 $goods_id=input('goods_id');
         // dump($goods_id);die;
       	 $ginfo=Db('tp_goods')->where("goods_id=$goods_id")->find();
       	 $this->assign('ginfo',$ginfo);
       	 // dump($ginfo);
       	 //查询相册信息
       	 $gallery=Db('tp_gallery')->where("goods_id=$goods_id")->select();
         $this->assign('gallery',$gallery);
         //查询属性信息
         $attrList=Db("tp_good_attr")
                                   ->alias("g")
                                   ->join("tp_attr a","a.attr_id=g.attr_id")
                                   ->field("g.attr_id,goods_attr_id,attr_name,attr_value,attr_index,attr_input_type")
                                   ->where("goods_id=$goods_id")
                                   ->select();

         // dump($attrList);
           $up=[];
           $down=[];
           foreach ($attrList as $key => $val) {
                 if($val['attr_index']==0 and $val['attr_input_type']>0){
                 	$up[]=$val;
                 }else{
                 	$down[]=$val;
                 }
           }

           $this->assign('down',$down);

           //处理规格
           foreach ($up as $key => $v) {
                 $attr[$v['attr_id']]['attr_name']=$v['attr_name'];
                 $attr[$v['attr_id']]['attr_value'][$v['goods_attr_id']]=$v['attr_value'];
           }
           $this->assign('attr',$attr);

           //防止规格为空
           if(!isset($attr)){
           	$attr=[];
           }
       	 
          return view();
       }
}