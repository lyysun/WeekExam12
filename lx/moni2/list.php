<?php 
include("model.php");
$model=new model();

$data=$model->select("moni2");


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
   <thead>
      <tr>
         <th>编码</th>
         <th>客户名称</th>
         <th>负责人</th>
         <th>公司电话</th>
           <th>描述</th>
               <th>状态</th>
      </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $key => $value) {?>
   <tr>
         <td><?php echo $value['code']?></td>
         <td><?php echo $value['name']?></td>
         <td><?php echo $value['ren']?></td>
          <td><?php echo $value['tel']?></td>
          <td><?php echo $value['nr']?></td>
          
          <td><?php echo isset($value['status'])?'未分配':"分配";?></td>
      </tr>
  <?php  }?>
      
     
   </tbody>
</table>
<script type="text/javascript" src="jquery-1.8.3.js"></script>
<script type="text/javascript">


</script>
</body>
</html>			