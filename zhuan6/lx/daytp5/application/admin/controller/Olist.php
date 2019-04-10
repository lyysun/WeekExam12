<?php
namespace app\admin\controller;
use  think\Db;
use  think\Controller;

class Olist extends Controller
{
          function index(){
          	$user_name=input('get.user_name','');
          	$where['user_name']=array('like',"%$user_name%");
             
             //转换成时间戳 
            $start=strtotime(input('get.start'));
            $end=strtotime(input("get.end"));
            if(!$start){
            	$start=1000000000;
            }
             if(!$end){
            	$end=9999999999;
            }else{
            	$end=$end+24*60*60;
            }
            $where['add_time']=array('between',"$start,$end");
            
             //升序降序
            $sort=input('get.sort',"升序");
            if($sort=="升序"){
            	$sort="asc";
            }else{
            	$sort="desc";
            }

          	$oList=Db('tp_order')
          	                   ->alias('o')
          	                   ->join("tp_user u","o.user_id =u.user_id")
          	                   ->field("order_id,goods_amount,add_time,pay_status,user_name,mobile_phone")
          	                   ->where($where)
          	                   ->order("order_amount $sort")
          	                   ->paginate(2);
          	 $page=$oList->render();
          // dump($oList);
          	 //变成数组
          	 $oList=$oList->toArray();
          	 $oList=$oList['data'];
          	 // dump($oList);
             //判断支付的状态
                  foreach ($oList as $key => $val) {
                  if($val['pay_status']==1){
                    $oList[$key]['pay_status']="是";
                  }else{
                    $oList[$key]['pay_status']="否";
                  }
                 }
                  session('oList',$oList);
                 
          	 //判断是否是Ajax
          	 if(request()->isAjax()){

          	 	foreach ($oList as $key => $val) {
          	 		//处理ajax显示的日期
          	 		$oList[$key]['add_time']=date("Y-m-d H:i:s",$val['add_time']);
          	 	 }  

                   $result['data']=$oList;
                   // dump($result);
                   $result['page']=$page;
                   return json($result);

          	 }
          	 $this->assign('oList',$oList);
          	 $this->assign('page',$page);
          	return view();
          }
        //生成Excel表格
      function getOrder(){
       //取session
       $orderList = session("oList");
      
       $header = array('订单号','下单时间','订单总金额','支付状态','会员名称','手机号');
       //拼成一个
       array_unshift($orderList,$header);
       //调用函数生成表格
       getExc($orderList,'order');
    }
}