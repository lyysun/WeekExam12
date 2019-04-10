<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Cat extends Controller
{
         function index(){
         	$catList=Db("tp_cat")->where("is_show=1")->select();
        	$cat=getThree($catList,0);
        	$this->assign('cat',$cat);


             //接cat_id
        	$cat_id=input("cat_id");
        	//找孩子
        	$son=getSon($catList,$cat_id);
        	//查找所有的id
        	$in='';
        	foreach ($son as $key => $val) {
        	$in.=','.$val['cat_id'];

        	}
        	$in.=substr($in,1);
        	$in=$in.','.$cat_id;
             //更具条件和查找
             $where['cat_id']=array('in',$in);
             $where['is_on_sale']=1;
             $where['is_delete']=0;
             $goodsList=Db('tp_goods')
                         ->field("goods_id,goods_name,shop_price,goods_thumb")
                         ->where($where)
                         ->select();
             $this->assign('goodsList',$goodsList);

        	 $flag=0;
        	$this->assign('flag',$flag);



         	return view();
         }
}