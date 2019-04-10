<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/aa/cs/zk2/Public/jquery-1.8.3.js"></script>
</head>
<body>
<h3>新闻添加</h3>
<form action="/aa/cs/zk2/index.php/Home/Index/insert" method="post">
	<table>
		<tr>
			<td>标题</td>
			<td>
			<input type="text" name="bt" id="bt">
			<span id="btin"></span></td>
		</tr>
		<tr>
			<td>内容</td>
			<td>
			<textarea name="nr" id="nr" cols="30" rows="10"></textarea>
			<span id="nrin"></span></td>
		</tr>
		<tr>
			<td>
			<input type="submit" value="确定">
			<input type="reset" value="返回"></td>
		</tr>
	</table>
</form>
	
</body>
<script type="text/javascript">
	$('#bt').blur(function(){
     var bt=document.getElementById('bt').value;
     var btin=document.getElementById('btin');
     if(bt!=''){
     btin.innerHTML="v";
     }else{
     	btin.innerHTML='标题不能为空';
     }
	});

	$('#nr').blur(function(){
     var nr=document.getElementById('nr').value;
     var nrin=document.getElementById('nrin');
     var reg=/^\w{5,}$/;
     if(reg.test(nr)){
     nrin.innerHTML="v";
     }else{
     	nrin.innerHTML='不能少于5个字符';
     }
	});
</script>
</html>