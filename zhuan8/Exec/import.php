<?php 

//一，根据Excel表单打印出里面的数据；

header("content-type:text/html;charset=utf-8");
include_once("Classes/PHPExcel.php");

//找到想要获取内容的excel
$excel=PHPExcel_IOFactory::load("1.xlsx");
//找到活动表（sheet）
$sheet=$excel->getActiveSheet();
//找到当前的Excel的最大列
$cols=$sheet->getHighestColumn();
//找到当前的Excel的最大行
$rows=$sheet->getHighestRow();

// 循环取出
for($i="A";$i<=$cols;$i++){

	for($j=2;$j<=$rows;$j++){
		$data[$j-2][]=$sheet->getCell($i.$j)->getValue();
	}
	
}
echo "<pre>";
print_r($data);


?>