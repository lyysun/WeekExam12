<?php 

// include("Db.php");
include("model.php");

// 调用Db公共的方法
// $obj=Db::getInstance();

$model=new model();
//多条件查询
// $data=$model->table('news')
//             ->fields('id,sum(num)')
//             ->join("type as t","n.news_id = t.news_id ","inner")
//             ->group("num")
//             ->where(["id"=>2])
//             ->order("id",'desc')
// 			->limit(4)
// 			->select();

$data = $model->table('news')->like("title","33")->select();
// var_dump($data);die;

//添加
// $data=$model->table("news")->add(['title'=>'lyy',"num"=>123]);

//修改
// $data=$model->table("news")->where(['id'=>1])->update(['title'=>"lyy","num"=>111]);

//删除
// $data=$model->table("news")->where(["id"=>1])->delete();

var_dump($data);

