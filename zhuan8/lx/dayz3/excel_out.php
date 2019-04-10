<?php 
include_once("Classes/PHPExcel.php");
header("content-type:text/html;charset=utf-8");

$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from dayz3")->fetchAll();

$excel = new PHPExcel();

// Set document properties
$excel->getProperties()->setCreator("yy")
							 ->setLastModifiedBy("yy")
							 ->setTitle("yy")
							 ->setSubject("yy")
							 ->setDescription("yy")
							 ->setKeywords("yy")
							 ->setCategory("yy");

	$sheet=$excel->setActiveSheetIndex(0);
            $sheet->setCellValue('A1', '名称')
            ->setCellValue('B1', '年龄')
            ->setCellValue('C1', '职位')
            ->setCellValue('D1', '工资');

     $i=2;
     foreach ($data as $key => $v) {
     	
             $sheet->setCellValue('A'.$i, $v['name'])
            ->setCellValue('B'.$i, $v['age'])
            ->setCellValue('C'.$i, $v['zw'])
            ->setCellValue('D'.$i, $v['m']);

            $i++;
     }
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="dd.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed


$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>