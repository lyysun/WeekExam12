<?php if (!defined('THINK_PATH')) exit();?><h3>文档列表</h3>
	<table border="1">
		<tr>
			<td><input type="checkbox"></td>
			<td>编号</td>
			<td>标题</td>
		</tr>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><input type="checkbox" name="box" value="<?php echo ($vo["id"]); ?>"></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["bt"]); ?></td>
				<td><a href="/aa/cs/zk2/index.php/Home/Index/delete/id/<?php echo ($vo["id"]); ?>" >单删</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<button class="del_all">批删</button>
	<button onclick="fun1()">全选</button>
	<button onclick="fun2()">全不选</button>
	<button onclick="fun3()">反选</button>