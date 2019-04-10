<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h4><a href="/aa/cs/dayz3/index.php/Home/Index/add">添加管理员</a></h4>

<form action="/aa/cs/dayz3/index.php/Home/Index/index" method="get">
	时间:<input type="text" name="time">
	用户名：<input type="text" name="dlm">
	<input type="submit" value="搜索">
</form>
<span>共有数据：<?php echo ($count); ?>条</span>
	<table border="1">
		<tr align="center">
		<td><input type="checkbox"  onclick="fun1()"></td>
		<td>id</td>
		<td>登录名</td>
		<td>手机</td>
		<td>邮箱</td>
		<td>角色</td>
		<td>加入时间</td>
		<td>是否起用</td>
		<td>操作</td>
		</tr>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><input type="checkbox" name="box" value="<?php echo ($vo["id"]); ?>"></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["dlm"]); ?></td>
				<td><?php echo ($vo["tel"]); ?></td>
				<td><?php echo ($vo["mail"]); ?></td>
				<td><?php echo ($vo["role"]); ?></td>
				<td><?php echo ($vo["time"]); ?></td>
				<td><?php echo ($vo["start"]); ?></td>
				<td><a href="/aa/cs/dayz3/index.php/Home/Index/delete/id/<?php echo ($vo["id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<button onclick="fun2()">反选</button>
</body>
<script type="text/javascript">
	function fun1()
	}
	function fun2()
	}
</script>
</html>