<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 内联表单</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<form class="form-inline"  method="post">

<div id="box">
      <div class="form-group">
         <label>菜单名称：</label>
         <input type="text" name="name[]" class="form-control" >
      </div>
       <div class="form-group">
         <label>事件类型：</label>
         <select name="type[]" class="form-control" >
            <option value="click">点击事件</option>
             <option value="view">视图事件</option>
         </select>
      </div>
      <div class="form-group">
         <label>事件内容</label>
         <input type="text" name="nr[]" class="form-control">
      </div>
      <input type="button" class="btn btn-success add" value="+">

 </div> 

   <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
<script src="js/jquery.min.js"></script>
<script>
   $(function(){
      $(".btn-success").on("click",function(){
            str="<div class='box'>"+$(this).parent().html()+"</div>";
            str=str.replace("+","-");
            str=str.replace("add","del");
            //添加到后面
            $(this).parent().after(str); 
      })

      $(document).on("click",".del",function(){
         $(this).parent().remove();
      })
   })
</script>
</html>