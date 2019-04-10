<?php 
header("content-type:text/html;charset=utf-8");
$dsn="mysql:host=127.0.0.1;dbname=2ykyy";
$pdo=new PDO($dsn,"root","root");
$data=$pdo->query("select * from goods")->fetchAll();
echo "<pre>";
// var_dump($data);
$num=array();
$name=array();
foreach ($data as $v) {
	$num[]=$v['num'];
   $name[]="'".$v['name']."'";

}
$num=implode($num,',');
$name=implode($name,',');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	 <div id="container" style="min-width:400px;height:400px"></div>
</body>
<script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>
<script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>
<script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
</html>
<script>
	
	var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '成绩'
    },
    subtitle: {
        text: '成绩'
    },
    xAxis: {
        categories: [<?php echo $name?>]
    },
    yAxis: {
        title: {
            text: '分数'
        },
        labels: {
            formatter: function () {
                return this.value + '分';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        
        name: '成绩',
       
        data: [<?php echo $num?>]
    }]
});

</script>