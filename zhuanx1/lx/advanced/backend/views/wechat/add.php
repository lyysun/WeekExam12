
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

<form role="form" method="post">
   <div class="form-group" >
      <label for="name">第一节课</label>
     
         <select name="name[]" id="" class="form-control">
            <?php foreach ($data as $key => $v) {?>
            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
           <?php }?>
         </select>
   </div>
    <div class="form-group">
      <label for="name">第二节课</label>
     
         <select name="name[]" id="" class="form-control">
            <?php foreach ($data as $key => $v) {?>
            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
           <?php }?>
         </select>
   </div>
    <div class="form-group">
      <label for="name">第三节课</label>
     
         <select name="name[]" id="" class="form-control">
            <?php foreach ($data as $key => $v) {?>
            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
           <?php }?>
         </select>
   </div>
    <div class="form-group">
      <label for="name">第四节课</label>
     
         <select name="name[]" id="" class="form-control">
            <?php foreach ($data as $key => $v) {?>
            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
           <?php }?>
         </select>
   </div>


   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>			