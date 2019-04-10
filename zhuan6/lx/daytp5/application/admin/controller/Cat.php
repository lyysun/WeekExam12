<?php
namespace app\admin\controller;
use  think\Db;
use  think\Controller;

class Cat extends Controller
{
    public function index()
    {
         //街商品的id
      $cat_id = input("cat_id");
  
      $catList = Db::name("tp_cat")->where('is_show = 1')->select();
      $cat = getThree($catList,0);
      $this->assign("cat",$cat);


       //导航栏
      $path=Db('tp_cat')->where("cat_id=$cat_id")->value('path');
     // echo $path;
       //转数组
      $path=explode('-',$path);
      //删除第一个为0的下表；
      array_shift($path);
     //向后追加一个元素
      array_push($path,$cat_id);
      // dump($path);
    //循环查询id 对应的产品名称
      foreach ($path as $key => $val) {
       $bread[]=Db("tp_cat")->where("cat_id=$val")->find();
       }
      // dump($bread);
       $this->assign('bread',$bread);
 


    //找孩子
      $son = getSon($catList,$cat_id);
   //拼接 那cat_id连接起来
      $in = '';
     foreach ($son as $key => $val) {
     	$in .= ','.$val['cat_id'];
      }

     //去掉第一个 0，
     $in = substr($in,1);

     $in = $in.','.$cat_id;
     
     $where['cat_id'] =array('in',$in);
     // dump($where);
     $where['is_on_sale'] = 1;
     $where['is_delete'] = 0;
     $goodsList = Db::name("tp_goods")->field('goods_id,goods_name,shop_price,goods_thumb')->where($where)->select();
    // dump($goodsList);


      $flag = 0;
     
      $this->assign("flag",$flag);
      $this->assign("goodsList",$goodsList);

 
       return view();
       
    }
}
