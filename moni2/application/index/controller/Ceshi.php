<?php
namespace app\index\controller;
use think\Controller;

class Ceshi extends Controller
{
    public function index()

     {
       return view("add");
    }

     public function add()

     {
     	$data=input("post.");
        $res=db("ceshi")->insert($data);
        if($res){
        	$this->success("添加成功","ceshi/show");
        }
       
    }

     public function show()

     {    
     	   $data=input("get.",'');

     	  $data=Db("ceshi")->where($data)->select();
          // var_dump($data);die;
          return view("show",["data"=>$data]);
    }
    public function del()

     { 
     	  $id=input("id");
     	  $data=Db("ceshi")->delete($id);
           if($data){
             echo json_encode(["code"=>1]);die;
           }
          
    }




}
