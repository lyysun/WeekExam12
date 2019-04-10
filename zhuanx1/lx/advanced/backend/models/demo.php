<?php

namespace backend\models;
use yii;
use yii\db\ActiveRecord;

class Demo extends ActiveRecord
{
    public function rules()
	{
		return [
           // ['字段',规则],
			['pid','integer'],			// 用户提交表单，传递过来的pid文本框中的值必须是整数
			// ['name','required'],			// 规则 required 指的是提交数据时，这个name文本框里必须有值
			// ['pid','required'],
			[['pid','name'],'required']	
        
		];

	}   
	// public function attributeLabels(){
	// 	return [
	// 		'pid'=>'商品分类',
	// 		'name'=>'商品名称',
	// 	];
	// } 

	public function generateTree($data,$id,$level){
		//$level=0;
		// 定义一个静态数态数组，这样反复调用getTree函数时，$arr中存储的值不会丢失，保留上一次存储后的值
		static $arr=array();
		// 使用递归方式进行处理（排序、层级）
		foreach ($data as $value) {
			// 用每个商品的pid和id对比，比如id是1，则说明要查找id是1的产品及各级别子产品
			if($value['pid']==$id){
				//$arr[]=$value;			// 将$value(注意，$value是个数组)放到$arr数组中，此时$arr就形成了二维数组
				$arr[]=[
					'id'=>$value['id'],
					'name'=>str_repeat('--', $level*2).$value['name']
				];
				//$level++;
				$this->generateTree($data,$value['id'],$level+1);		// 查找当前子类下的子类

			}
		}
		return $arr;
	}
    
  
 

}