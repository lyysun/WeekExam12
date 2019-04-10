<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 实例 - 标题</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>

<h1>我是标题1 h1</h1>
<div class="container" style="padding: 100px 50px 10px;" >
 <button type="button" class="btn btn-default" title="Popover title"  
      data-container="body" data-toggle="popover" data-placement="left" 
      data-content="左侧的 Popover 中的一些内容">
      左侧的 Popover
   </button>
   <button type="button" class="btn btn-primary" title="Popover title"  
      data-container="body" data-toggle="popover" data-placement="top" 
     data-content="顶部的 Popover 中的一些内容">
     顶部的 Popover
   </button>
   <button type="button" class="btn btn-success" title="Popover title"  
      data-container="body" data-toggle="popover" data-placement="bottom" 
      data-content="底部的 Popover 中的一些内容">
      底部的 Popover
   </button>
   <button type="button" class="btn btn-warning" title="Popover title"  
      data-container="body" data-toggle="popover" data-placement="right" 
      data-content="右侧的 Popover 中的一些内容">
      右侧的 Popover
   </button>
   </div>
 
  <script>$(function () 
      { $("[data-toggle='popover']").popover();
     });
   </script>
</div>

<div class="row">

  <div class="center-block" style="width:200px;background-color:#ccc;">
      这是 center-block 实例
  </div>
</div>


</body>
</html>			