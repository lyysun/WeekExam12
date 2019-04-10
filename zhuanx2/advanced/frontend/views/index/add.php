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

<form role="form" action="<?=Url::to(['index/add'])?>" method="post">
   <div class="form-group">
      <label for="name">名称</label>
      <input type="text" class="form-control" id="name" 
         placeholder="请输入名称" name="type_name">
   </div>

     <div class="form-group">
      <label for="name">pid:</label>

       <select name="pid" class="form-control"> 
          <option value="0">顶级菜单 </option>
            <?php foreach ($a   as $key => $value) {?>
              <option value="<?=$value['type_id']?>"><?=$value['type_name']?>  </option>
          <?php }?>
           

          </select>
      
   </div>
   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			