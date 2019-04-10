 <?php 
use yii\helpers\Url;
 ?>
 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基础表格</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">

</head>
     <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>姓名</th>
                                    <th>工资</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $key => $value): ?>
                            	<tr>
                                    <td><?=$value['id']?></td>
                                    <td><?=$value['name']?></td>
                                    <td><?=$value['num']?></td>
                                    <td><a href="<?=Url::to(['text/del','id'=>$value['id']])?>">删除|| <a href="<?=Url::to(['text/update_show','id'=>$value['id']])?>">编辑</a></a></td>
                                </tr>
                                
                            <?php endforeach ?>
                                
                            </tbody>
                        </table>

                    </div>
	
</body>
</html>