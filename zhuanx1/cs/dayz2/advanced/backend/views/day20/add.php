<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 基本表单</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<form role="form">
   <div class="form-group">
      <label for="name">名称</label>
      <input type="text" class="form-control" name="name" id="name" 
         placeholder="请输入名称">
   </div>
    <div class="form-group">
      <label for="name">父级菜单</label>
      <select name="pid" id="" class="form-control">
         <option value="0">衣服</option>

      </select>
   </div>
   <div class="form-group">
      <label for="name">菜单类型</label>
      <select name="type" id="" class="form-control">
         <option value="click">点击事件</option>
         <option value="view">链接URL</option>
         
      </select>
   </div>
    <div class="form-group">
      <label for="name">菜单级别</label>
      <select name="level" id="" class="form-control">
         <option value="1">一级菜单</option>
         <option value="2">二级菜单</option>
         
      </select>
   </div>
   <div class="form-group">
      <label for="name">菜单内容</label>
      <input type="text" class="form-control" name="val" id="name" 
         placeholder="请输入内容">
   </div>

   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			