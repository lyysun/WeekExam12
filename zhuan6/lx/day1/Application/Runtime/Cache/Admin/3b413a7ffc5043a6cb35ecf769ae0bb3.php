<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 节点管理 </title>
<base href="/zhuan6/lx/day1/Public/admin/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Node/add');?>">添加节点</a></span>
<span class="action-span1"><a href="<?php echo U('Index/index');?>">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 节点列表 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>节点名称</th>					
					<th>控制器</th>
					<th>方法</th>
					<th>操作</th>
				</tr>
                 <?php if(is_array($nodelist)): foreach($nodelist as $key=>$v): ?><tr align="center" class="0" id="0_1">
                    <td><span title="点击修改内容" style=""><?php echo ($v["title"]); ?></span></td>
                    <td><span title="点击修改内容" style=""><?php echo ($v["controller"]); ?></span></td>
                    <td><span title="点击修改内容" style=""><?php echo ($v["action"]); ?></span></td>
					<td width="24%" align="center">
						<a href="">编辑</a> |
						<a href="" onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">移除</a>
					</td>
				</tr><?php endforeach; endif; ?>
               
        
	
	</tbody>
  </table>
</div>
</form>

  </table>
</div>
</form>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>