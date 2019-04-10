<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<base href="/zhuan6/cs/day6/Public/Admin/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="content">


</div>
</body>
<script type="text/javascript" src="/zhuan6/cs/day6/Public/js/jquery-1.8.3.js"></script>
<script type="text/javascript">
  function request(page){
         $.ajax({
          url:"/zhuan6/cs/day6/index.php/Admin/Index/ajax",
          type:"post",
          data:{page:page},
          success:function(res){
              $('.content').html(res);
              $('div a').attr('href','javascript:;');
              $("div a").live('click',function(){
               // alert(1)
               

              })

          }
         })

  }request(1);
</script>
</html>