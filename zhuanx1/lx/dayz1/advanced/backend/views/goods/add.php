<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 基本表单</title>
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<form role="form" method="post">
   <div class="form-group">
   
      <label for="name">名称</label>
      <input type="text" name="goods[name]" class="form-control" id="name" 
         placeholder="请输入名称">
   </div>
   <div class="form-group">
      <label for="name">售价</label>
      <input type="text" name="goods[sj]" class="form-control" id="name" 
         placeholder="请输入售价">
   </div>
    <div class="form-group">
      <label for="name">类别</label>
      <input type="text" name="goods[lb]" class="form-control" id="name" 
         placeholder="请输入类别">
   </div>
    
  
   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			