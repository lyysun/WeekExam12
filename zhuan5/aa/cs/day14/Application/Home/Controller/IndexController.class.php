<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$Day13=M('day13');
    	$p=isset($_GEt['p'])?$_GET['p']:1;

    	$data=$Day13->page($p,"2")->select();
    	$this->assign('data',$data);
    	$count=$Day13->count();
    	$Page=new \Think\Page($count,2);
    	$show=$Page->show();
    	$this->assign('page',$show);
    
        $this->display('add');

    }



    	)
}  


 create database bbb;
 use bbb;
    create table user(
    	id int unsigned not null auto_increment primary key,
    	userName varchar(32) not null default "",
    	password char(32) not null default "",
    	)engine=myisam default varchar=utf8;