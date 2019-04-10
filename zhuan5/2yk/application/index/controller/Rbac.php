<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Request;
use app\index\model\IndexModel;
class Rbac extends Controller
{
          
          function _initialize(){
                
                  $session=Session::get();
                  // dump($session);
                 if(!isset($session['name'])){
                     $this->error("请先登录","index/login/index");
                 }else{

                 	    if($session['name']!="root"){
                 	    	// 获取控制器和方法  
                            $request=Request::instance();
                            $ctl=$request->controller();//获取控制器
                            $act=$request->action();//获取方法名称
                            $nowurl=$ctl."/".$act;//进行拼接  User/index
                            $nowurl=strtolower($nowurl);//进行转换 user/index
                            // dump($nowurl);
                            if(empty($session['urls'])) {
                            	$session['urls']=array();
                            }
                            $res=in_array($nowurl,$session['urls']);
                            if(!$res){
                                $this->error("您没有访问的权限","index/index/index");
                            }

                 	    }

                 }
                   
          }
         
        //展示角色
          function showrole(){
            $data=Db('role')->select();
            $this->assign('data',$data);
            return view();
          }

       //展示权限列表
         function shownode(){

             $roleid=input('id');
             $rolename=Db('role')->where("id=$roleid")->find();
             $this->assign("rolename",$rolename);//展示给{$rolename.name}分配权限
            // dump($session);die;
            $data=Db('node')->select();
            $this->assign('data',$data);
            return view("list");
         }
         //分配权限
         function addnode(){
              $roleid=input('roleid');
              $nodeid=input("nodeid/a");
              foreach ($nodeid as $k => $v) {
                  $data['roleid']=$roleid;
                  $data['nodeid']=$v;
                  Db("role_node")->insert($data);
              }
           $this->success("分配成功","index/rbac/showrole");

         }


          //展示添加学生信息form表单
         function add(){
              return view();
          }
       //添加学生信息
         function adddata(){
           $data=input("get.");
           // dump($data);die;
           $res=Db("student")->insert($data);
           // echo $res;die;
           if($res){
            $this->success("添加成功","index/Rbac/show");
           }
         }
         //展示学生信息列表
         function show(){
               
               return view();
         }
         //ajax展示学生信息列表
          function ajax(){
               $data=$this->request->param();
               $name="";
               $name=$data['name'];
               
               $a=new IndexModel();
               $data=$a->selects($name);
               $json=json_encode($data);
               $this->assign('json',$json);

               $data=$a->selects($name);
               $page=$data->render();
               $this->assign('page',$page);
               
               return view();
         }

         //ajax批删
         function delall(){
            $data=$this->request->param();
            $ids=$data['ids'];
            $a=new IndexModel();
            $res=$a->delall($ids);
           if ($res>0) {
               echo json_encode(array("code"=>1,"msg"=>"yse"));
            }else{
                echo json_encode(array("code"=>2,"msg"=>"no"));
            }

         }
         //几点技改
         function xg(){
            $data=$this->request->param();
            $id=$data['id'];
           $name=$data['name'];
            $a=new IndexModel();
            $res=$a->xg($id,$name);
            if ($res>0) {
               echo json_encode(array("code"=>1,"msg"=>"yse"));
            }else{
                echo json_encode(array("code"=>2,"msg"=>"no"));
            }

         }

       
            


}