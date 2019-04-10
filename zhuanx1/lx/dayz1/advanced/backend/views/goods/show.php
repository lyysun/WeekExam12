<?php 
// use yii\heplers\Url;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
   
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<form role="form" action="<?=Url::to(['goods/show'])?>" method="post">
   <div class="form-group">
      <label for="name">名称</label>
      <input type="text" name="name" class="form-control" id="name" 
         placeholder="请输入名称">
   </div>
   
    
  
   <button type="submit" class="btn btn-default">搜索</button>
</form>

<table class="table table-striped">
  
   <thead>
      <tr>
         <th>名称</th>
         <th>售价</th>
         <th>类别</th>
         <th>时间</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
   <?php foreach ($data as $key => $value) {?>
     <tr>
         <td><?=$value['name']?></td>
         <td><?=$value['sj']?></td>
         <td><?=$value['lb']?></td>
         <td><?= date("Y-m-d H:i:s")?></td>
         <td>
         <a href="<?=Url::to(['goods/del','id'=>$value['id']])?>">删除</a>
      <a href="<?=Url::to(['goods/update_show','id'=>$value['id']])?>">修改</a>

         </td>

      </tr>
  <?php }?>
     
      
   </tbody>
</table>

</body>
</html>			