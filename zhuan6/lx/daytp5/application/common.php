<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function nodedg($arr,$parent_id=0,$level=1){
	static $list=array();
	foreach ($arr as $k => $v) {
		if($v['parent_id']==$parent_id){
           $v['level']=$level;
           $list[]=$v;
           nodedg($arr,$v['cat_id'],$level+1);
		}
	}
	return $list;
}

// 三级分类-找到孩子装进父亲son下标
function getThree($data,$parentId = 0){
  $arr = [];
  foreach ($data as $key => $val) {

    if($val['parent_id']==$parentId){

        
        $val['son'] = getThree($data,$val['cat_id']);
        $arr[]= $val;
    }
  }
  return $arr;
}
// * 找孩子
function getSon($data,$parent_id=0){
	static $arr=[];
	foreach ($data as $key => $val) {
           if($val['parent_id']==$parent_id){
           	$arr[]=$val;
           	getSon($data,$val['cat_id']);
           }
	}
	return $arr;
}


function getExc($arr,$filename){
    
      //1.实例化PHPExcel类 等同于在桌面上新建一个excel
      $objPHPExcel = new \PHPExcel();

      //2.设定活动sheet
      $objPHPExcel->setActiveSheetIndex(0);
      //3.获取活动表
      $objSheet = $objPHPExcel->getActiveSheet();


      //$objSheet->setCellValue('A1','姓名')->setCellValue('B1','年龄');
     // $objSheet->fromArray($h);
      $objSheet->fromArray($arr);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
      header('Cache-Control: max-age=0');
      //5.生成excel文件
      $objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

      $objWriter->save("php://output");//输出到浏览器
    }