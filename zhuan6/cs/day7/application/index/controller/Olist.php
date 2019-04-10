<?php
namespace app\index\controller;
use think\Controller;
class Olist extends Controller
{
         function index(){
         	$user_name=input('get.user_name');
         	$where['user_name']=array('like',"%$user_name%");

            $start=strtotime(input('get.start'));
            $end=strtotime(input('get.end'));
              
              if(!$start){
              	$start=1000000000;
              }
              if(!$end){
              	$end=9999999999;
              }else{
              	$end=$end+24*60*60;
              }
             $where['add_time']=array('between',"$start,$end");
             $sort=input('get.sort',"升序");
          
             if($sort=="升序"){
             	$sort="asc";
             }else{
             	$sort="desc";
             }

         	$olist=Db('tp_order')
         	              ->alias('o')
         	              ->join("tp_user u","o.user_id=u.user_id")
         	              ->field("user_name,mobile,order_id,order_sn,pay_status,goods_amount,add_time")
         	              ->where($where)
         	              ->order("order_amount $sort")
                          ->paginate(2);
         	  // dump($olist); 
         	 $page=$olist->render();
             $olist=$olist->toArray();
             // dump($olist);die
             $olist=$olist['data'];
             if(request()->isAjax()){
                  $result['data']=$olist;
                  $result['page']=$page;
                  return json($result);

             }
             $this->assign('page',$page);
         	$this->assign('olist',$olist);
         	return view();
         }
}