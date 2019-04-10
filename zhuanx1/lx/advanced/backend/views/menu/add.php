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
      <label for="name">父级菜单</label>
      <select  name="pid" class="form-control">
            <option value="0">顶级菜单</option>
            <?php foreach ($data as $key => $value) {?>
              <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
            <?php }?>
           
          
     </select>


   </div>
   <div class="form-group">
      <label for="name">菜单名称</label>
      <input type="text" name="name" class="form-control" id="name" 
         placeholder="请输入菜单名称">
   </div>
   <div class="form-group">
      <label for="name">类型</label>
      <select name="type" class="form-control">
            <option value="click">click</option>
          <option value="view">view</option>
          
    </select>

   </div>
   <div class="form-group">
      <label for="name">类型对应的值</label>
      <input type="text" name="val" class="form-control" id="name" 
         placeholder="请输入类型对应的值">
   </div>
   <div class="form-group">
      <label for="name">层级</label>
       <select name="level" class="form-control">
           <option value="1">一级菜单</option>
               <option value="2">二级菜单</option>
          
     </select>

   </div>

   
   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			