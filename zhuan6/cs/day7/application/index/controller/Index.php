<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
  function index(){
    // echo "1";
    //查询热销商品
     $where['is_hot']=1;
     $where['is_on_sale']=1;
     $where['is_delete']=0;
         $hotGoods=Db('tp_goods')
                                 ->field('goods_id,goods_name,goods_brief,goods_thumb,shop_price')
                                 ->where($where)
                                 ->select();
         // dump($hotGoods);
         $this->assign('hotGoods',$hotGoods);

    $catList=Db('tp_cat')->where('is_show = 1')->select();
    $cat=getThree($catList,0);
    $this->assign("cat",$cat);
    // dump($cat);
    // $this->assign('cat',$cat);
    //获取楼层
    $floor=1;
    $floor=$this->getFloor($catList,$floor);
        $this->assign('floor',$floor);

    $flag=1;
    $this->assign("flag",$flag);
    return view();
  }

//获取楼层的调用方法
  function getFloor($catList,$floor=1){
     //1及分类的名字
    $oneName=Db('tp_cat')->where("cat_id=$floor")->value("cat_name");
           // dump($oneName) ;
    //2及分类名字
    foreach ($catList as $key => $val) {
      if($val['parent_id']==$floor){
        $twoList[]=$val;
      }
    }
    // dump($twoList);
    //找商品
     $son = getSon($catList,$floor);
     $in='';
     foreach ($son as $key => $val) {
     $in.=','.$val['cat_id'];
     }
     $in=substr($in,1);
     $where['is_on_sale']=1;
     $where['is_delete']=0;
     $where['cat_id']=array("in",$in);

     $goods=Db('tp_goods')->field('goods_id,goods_name,goods_brief,goods_thumb,shop_price')
     ->where($where)->select();
        // dump($goods);
     return array("oneName" => $oneName,"twoList" => $twoList,"goods" => $goods);

  }


}