<?php 

//一，根据mysql数据库的内容打印在Excel表里；

header("content-type:text/html;charset=utf-8");
include_once('Classes/PHPExcel.php');
$pdo=new PDO("mysql:host=127.0.0.1;dbname=2ykyy","root","root");
$data=$pdo->query("select * from weather")->fetchAll();

$excel=new PHPExcel();
$excel->getProperties()->setCreator("yy")
							 ->setLastModifiedBy("tt")
							 ->setTitle("yy")
							 ->setSubject("yy")
							 ->setDescription("yy")
							 ->setKeywords("yy")
							 ->setCategory("yy");
	//设置活动单元格
	$sheet=$excel->setActiveSheetIndex(0);
	//给表单在设置值
	$sheet->setCellValue("A1","days")
	      ->setCellValue("B1","week")
	      ->setCellValue("C1","citynm");
	 $i=2;
	 foreach ($data as $key => $v) {
	 	 $sheet->setCellValue("A".$i,$v['days'])
		      ->setCellValue("B".$i,$v['week'])
		      ->setCellValue("C".$i,$v['citynm']);
	      $i++;
	 }
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="demo.xlsx"');
header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>