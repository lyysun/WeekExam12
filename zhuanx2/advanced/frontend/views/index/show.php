<?php 

use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 条纹表格</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-striped">
   <caption>条纹表格布局</caption>
   <a href="<?=Url::to(['index/add'])?>">添加</a>
   <thead>
      <tr>
         <th>id</th>
         <th>类型</th>
         <th>pid</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
      <?php foreach ($a as $v) {?>
      <tr>
         <td><?=$v['type_id']?></td>
         <td><?=$v['type_name']?></td>
         <td><?=$v['pid']?></td>
         <td>
               <a href="<?=Url::to(['index/del','type_id'=>$v['type_id']])?>">删除 || </a>
                <a href="<?=Url::to(['index/update','type_id'=>$v['type_id']])?>">修改</a>
            </td>
      </tr>
      <?php }?>
      
   </tbody>
</table>

</body>
</html>        