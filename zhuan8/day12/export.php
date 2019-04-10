 <?php 
 // echo phpinfo();
 $redis = new Redis();
 // var_dump($redis);die;
 $redis->connect("127.0.0.1",'6380');
 $redis->set('ee','44');
 echo $redis->get("ee");die();
 // header("content-type:text/html;charset=utf-8");
// include_once("Classes/PHPExcel.php");
// $dsn = 'mysql:dbname=2ykyy;host=127.0.0.1';
// $user = 'root';
// $password = 'root';

// try {
//     $pdo = new PDO($dsn, $user, $password);
//     $data=$pdo->query("select * from weather")->fetchAll();
//     // var_dump($data);
//     $excel=new PHPExcel();
//     $excel->getProperties()->setCreator("yy")
// 							 ->setLastModifiedBy("yy")
// 							 ->setTitle("yy")
// 							 ->setSubject("yy")
// 							 ->setDescription("yy")
// 							 ->setKeywords("yy")
// 							 ->setCategory("yy");
//     $i=2;
//     $excel->setActiveSheetIndex(0)
//             ->setCellValue('A1', 'days')
//             ->setCellValue('B1', 'week')
//             ->setCellValue('C1', 'citynm');
           
//    foreach ($data as $key => $v) {
//           $excel->setActiveSheetIndex(0)
//             ->setCellValue('A'.$i, $v['days'])
//             ->setCellValue('B'.$i, $v['week'])
//             ->setCellValue('C'.$i, $v['citynm']);
//             $i++;
//    }

//    // Redirect output to a client’s web browser (Excel2007)
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="dome.xlsx"');
// header('Cache-Control: max-age=0');

// $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
// $objWriter->save('php://output');
// exit;

    

// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
// }




// 
?>