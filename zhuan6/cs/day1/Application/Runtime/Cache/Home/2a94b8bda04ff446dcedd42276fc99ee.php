<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="">
	<table>
		<tr>
		<td>用户名：</td>
			<td><input type="text" placeholder="您的账户和登录名" id="name" onblur="namea()"> <span id="namein"></span></td>
		</tr>
		<tr>
		<td>设置密码：</td>
			<td><input type="text" placeholder="建议至少两种字符"></td>
		</tr>
		<tr>
		<td>确认密码：</td>
			<td><input type="text" placeholder="确认密码"></td>
		</tr>
		<tr>
		<td>中国0086</td>
			<td><input type="text" placeholder="建议使用超手机"></td>
		</tr>
		<tr>
		<td>验证码</td>
			<td><input type="text" placeholder="请输入验证码"></td>
		</tr>
		<tr>
		<td>手机码</td>
			<td><input type="text" placeholder="请输入手机码"></td>
		</tr>
		<tr>
		<td></td>
			<td><input type="submit" placeholder="立即注册"></td>
		</tr>
	</table>
</form>
	
</body>
<script type="text/javascript">
	function namea(){
		name=document.getElementById('name').value;
		namein=document.getElementById('namein');
		if(name==''){
			namein.innerHTML="不能为空";
           // alert("您的账户和登录名");
		}
	}
</script>
</html>