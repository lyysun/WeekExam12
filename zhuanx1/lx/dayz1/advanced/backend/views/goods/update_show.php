<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 基本表单</title>
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<form role="form" method="post" action="<?=Url::to(['goods/update_do'])?>">
   <div class="form-group">

      <label for="name">名称</label>
      <input type="text" name="name" class="form-control" id="name" 
         value="<?=$name?>">
         <input type="hidden" value="<?=$id?>" name="id">
   </div>
   <div class="form-group">
      <label for="name">售价</label>
      <input type="text" name="sj" class="form-control" id="name" 
        value="<?=$sj?>">
   </div>
    <div class="form-group">
      <label for="name">类别</label>
      <input type="text" name="lb" class="form-control" id="name" 
         value="<?=$lb?>">
   </div>
    
  
   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			