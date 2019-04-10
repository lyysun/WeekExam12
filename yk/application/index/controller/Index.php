<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Index extends Controller
{
    public function index()
    {

       return view("login");
    }
    public function login(){
    	$data=input("post.");
    	$name=$data['name'];
    	$pwd=$data['pwd'];
    	$res=db("yprize_user")->where(['name'=>$name,'pwd'=>$pwd])->find();
        Session::set("user_id",$res['user_id']);
         if($res){
         	$this->success("登陆成功",'index/showprize');
         }else{
         	$this->error("密码或账号有误");
         }
    }
    //抽奖列表 (7)	奖品主列表的展示
    public function showprize(){
          $data=db("yprize_c")->select();
          return view("showprize",['data'=>$data]);

    }
    // (8) 奖品的新增
    public function addprize(){
    	 if($_POST){
               $data=input("post.");
               $res=db("yprize_c")->insert($data);
               if($res){
               	    $this->success("添加成功",'index/showprize');
               }
    	 }else{
    	 	return view("addprize");
    	 }
    }
 //(9)  奖品的修改与删除(
  public function prizedel(){
        $data=input("get.");
      $id=$data['id'];
      $res=db("yprize_c")->delete($id);
         if($res){
          echo json_encode(['code'=>1]);
         }

      
   }

    //抽奖
    public function chou(){
         $data=db("yprize_c")->select();
         $prize_name=$this->prize($data);

         db("yprize_c")->where('prize_name',$prize_name)->setInc("prize_num",-1);
         $user_id=Session::get("user_id");
         $detail=['user_id'=>$user_id,"prize_name"=>$prize_name,"prize_num"=>1,"time"=>time()];
          $res=db("yprize_d")->insert($detail);
           if($res){
              echo json_encode(['code'=>1,'prize_name'=>$prize_name]);
           }
        
    }
    //抽奖算法
   public function prize($data){
       $arr=[];
       foreach ($data as $key => $value) {
       	       
               for ($i=0; $i < $value['prize_num'] ; $i++) { 
                         $arr[].=$value['prize_name'];
               }
       }
       $list=array_rand($arr);
    
         return $arr[$list];

   }

   //(1)	用户主列表展示
   public function usershow(){
   
   	  	$data=db("yprize_user")->paginate(2);
   	  	return view("usershow",['data'=>$data]);
   	
   }
   // 用户添加
   public function useradd(){
   	  if($_POST){
             $data=input("post.");
             $res=db("yprize_user")->insert($data);
             if($res){
             	$this->success("添加成功",'index/usershow');
             }
   	  }else{
   	  	return view("useradd");
   	  }
   }
  //删除
   public function userdel(){
        $data=input("get.");
    	$id=$data['id'];
    	$res=db("yprize_user")->delete($id);
         if($res){
         	echo json_encode(['code'=>1]);
         }

   	  
   }
  // (5)	中奖名单主列表展示
   public function listprize(){
   	   $data=db("yprize_d")->alias('a')->join("yprize_user u","a.user_id=u.user_id")->select();
   	   // var_dump($data);die;
   	   return view("listprize",['data'=>$data]);
   }
 //删除
   public function listdel(){
    	$data=input("get.");
    	$id=$data['id'];
    	$res=db("yprize_d")->delete($id);
         if($res){
         	echo json_encode(['code'=>1]);
         }
   }


}
