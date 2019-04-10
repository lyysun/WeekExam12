<?php
namespace app\index\controller;
use think\Controller;
class Cat extends Controller
{
   

   public function index(){


   	
   }

   
   public function add1(){
    // echo 1;die;

              return view("add1");
    
   }
      
    public function add(){
    	if($_POST){
            $data=input("post.");
            $parent_id=$data['parent_id'];
            //判断parent_id 不等于0 进行添加
            if($parent_id!=0)
            { 
             $where['cat_id']=$parent_id;
             //商品的path-parent_id路径
             $fpath=Db("tp_cat")->where($where)->value("path");
             // "0-20"
      
             $data['path']=$fpath."-".$parent_id;
              // "0-20-22"

            }else{
            	$data['path']=0;//顶级菜单 parent_id=0；
            }
                $res=Db("tp_cat")->insert($data);
                if($res){
                	$this->redirect("cat/index");
                }



    	}else{
           $data=Db("tp_cat")->select();
           $arr=nodedg($data);
           $this->assign('data',$arr);
    		return view("add");
    	}
    	
    	
    }
}
