<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Prize extends Controller
{
    public function login()
    {
       return view("login");
    }
    public function logindl()
    {
      $data=input("post.");
      $data=db("prize_user")->where($data)->find();
      // var_dump($data);die;
       Session::set("user_id",$data['user_id']);

       if($data){
       	$this->success("登陆成功",'prize/prizeshow');
       }else{
        $this->error("密码或账号有误!");
       }
    }

    public function prizeshow(){
    	$data=db("prize_c")->select();
    	return view("show",['data'=>$data]);
    }
    //抽奖
    public function chou(){
         $data=db("prize_c")->select();
         //调用封装抽奖方法
         $name=$this->prize($data);
         $user_id=Session::get("user_id");
         //查询是否抽过奖
         $res=db('prize_d')->where("user_id",$user_id)->select();
         if($res){
         	 echo json_encode(['code'=>2]);die;
         }
         //修改数量
         db("prize_c")->where("prize_name",$name)->setInc("num",-1);
         //添加奖品名单
         $data=["user_id"=>$user_id,'prize_name'=>$name,'time'=>time()];
         db("prize_d")->insert($data);

        echo json_encode(['code'=>1,'name'=>$name]);die;

    }
    
    //奖品的修改展示
    public function updateshow(){
      $prize_id=input("prize_id");
      $data=db("prize_c")->where("prize_id",$prize_id)->find();
      // var_dump($data);die;
      return view("updateshow",['data'=>$data]);
    }
    //奖品的修改
    public function update(){
      $data=input("post.");
      $prize_id=$data['prize_id'];

      $arr=['prize_name'=>$data['name'],'num'=>$data['num']];

      $res=db("prize_c")->where("prize_id",$prize_id)->update($arr);
      if($res){
        $this->success("修改成功",'prize/prizeshow');
      }
    }

   //用户展示
   public function usershow(){
   	    $data=db("prize_user")->paginate(2);
   	    return view('usershow',['data'=>$data]);
   }
   //用户添加
   public function useradd(){
   	   if($_POST){
   	   	$data=input("post.");
   	   	  $res=db("prize_user")->insert($data);
           if($res){
           	  $this->success("注册成功",'prize/usershow');
           }
   	   }else{
   	   	return view("useradd");
   	   }

   }
   //用户删除
   public function userdel(){
   	$user_id=input("user_id");
   	 $res=db('prize_user')->delete($user_id);
   	 if($res){
   	 	$this->success("删除成功",'prize/usershow');
   	 }
   }

   //封装抽奖
    public function prize($data){
      $arr=[];
       foreach ($data as $key => $value) {
   	      for ($i=0; $i < $value['num']; $i++) { 
   	              $arr[].=$value['prize_name'];
   	        }

         }
     $data=array_rand($arr,1);//从数组中随机抽一个
      $name=$arr[$data];
    	return $name;
    	
    	 }
    
}
