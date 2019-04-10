<?php

namespace app\index\controller;
use think\Controller;
use think\Session;
class Redbeg extends Controller
{
    public function index()
    {
    	$data=Db("red_user")->find();
        Session::set('user_id',$data['user_id']);//存用户id
        //展示红包的信息
        $reddata=Db("redbeg")->select();
        return view("show",['data'=>$data,'reddata'=>$reddata]);
    }
     
      //红红html页
     public function sendred(){
     	return view("sendred");
     }
    //接受红包的数据
     public function redadd(){
     	$data=input("post.");
     	$m=$data['zm'];
     	$n=$data['num'];
     	//红包总金额不能小于：红包份数 * 0.01
        if($m<$n*0.01){

        	 $this->error('红包总金额不能小于');die;
        }
         //存放用户user_id
        $user_id=Session::get('user_id');
        //根据用户查询总金额
        $zmoney=db("red_user")->where('user_id',$user_id)->find();
       
        //判断总金额要大于  发红包的金额
        if($zmoney['m']<$m){
             $this->error('金额不足');die;
        
        }
         //总金额-发红包的金额=更新后的总金额
         $zm=$zmoney['m']-$m;
         //修该总金额
        db('red_user')->where('user_id',$user_id)->update(['m'=>$zm]);
        //添加红包表
        $data1=['zm'=>$m,'num'=>$n,'snum'=>$n];
        $res=Db('redbeg')->insert($data1);

        //查询红包最后一个 red_id 计算红包明细 （金额）（份数）
        $red_id=Db("redbeg")->order("red_id",'desc')->find();
   
        $red_id=$red_id["red_id"];
        //调用redbeg方法 获取单个红包明细
        $reddata=$this->redbeg($m,$n);
          
         //添加红包明细入库和红包red_id;
         foreach ($reddata as $key => $value) {
                
                 Db("red_mx")->insert(["red_id"=>$red_id,"one_m"=>$value]);
         }
          
         $this->success("发送成功","redbeg/index");
      
     }

     //抢红包
     function robred(){
     	$user_id=Session::get("user_id");
     	//所抢红包的red_id
     	$red_id=input("red_id");
     	//查看金额是否强光（）

     	$data=Db("redbeg")->where("red_id",$red_id)->find();
     	$zm=$data['zm'];
     	if($zm==0){
     		//红包强光
     		echo json_encode(['code'=>1]);die;
     	}
        $data=Db("red_mx")->where("red_id",$red_id)->where("user_id",$user_id)->select();
        // var_dump($data);die;
        if($data){
        	//你已抢过
        	echo json_encode(['code'=>2]);die;
        }
        
        //查出一条未领取的红包
        $reddata=Db("red_mx")->where("red_id",$red_id)->where("status",0)->find();
        //抽到的金额
        $one_m=$reddata['one_m'];
        //根据红包red_id和抽到金额  修改 状态 用户 时间
        Db("red_mx")->where('red_id',$red_id)->where("one_m",$one_m)->update(['status'=>1,'user_id'=>$user_id,'time'=>time()]);
        //抽奖人的总金额+红包的金额
        db("red_user")->where("user_id",$user_id)->setInc("m",$one_m);
        //红包分数-1
        db("redbeg")->where("red_id",$red_id)->setInc("snum",-1);
        //红包的金额-抽到的红包=剩下红包的金额
        db("redbeg")->where("red_id",$red_id)->setInc("zm",-$one_m);
        echo json_encode(["code"=>3,"one_m"=>$one_m]);die;

     }
 //红包算法 
     public function redbeg($m,$n){
            $arr=[];
              $min=0.01;
              for ($i=1; $i < $n; $i++) { 
              	  //限制安全线
                   $max=($m-($n-$i)*$min)/($n-$i);
                   $money=mt_rand($min*100,$max*100)/100;
                   $m=$m-$money;
                   $arr[]=$money;

              }
              //把剩下的钱再放到数组
              $arr[]=$m;
              return $arr;

     }

}
