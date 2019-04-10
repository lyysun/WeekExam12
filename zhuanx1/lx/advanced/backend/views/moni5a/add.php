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

<form role="form" action="<?=Url::to(['moni5a/add'])?>" method="post" enctype="multipart/form-data">
   <div class="form-group">
      <label for="name">图文标题</label>
      <input type="text" class="form-control" name="title" id="name" 
         placeholder="请输入图文标题">
   </div>
   <div class="form-group">
      <label for="inputfile">文件输入</label>
      <input type="file" name="file" id="inputfile">
     
   </div>
    <div class="form-group">
      <label for="name">图文简介</label>
      <input type="text" class="form-control" name="jj" id="name" 
         placeholder="请输入图文标题">
   </div>
    <div class="form-group">
      <label for="name">封面链接</label>
      <input type="text" class="form-control" name="furl" id="name" 
         placeholder="请输入图文标题">
   </div>
    <div class="form-group">
      <label for="name">跳转网址</label>
      <input type="text" class="form-control" name="link" id="name" 
         placeholder="请输入图文标题">
   </div>
   
   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			