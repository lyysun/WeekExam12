<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<base href="/zhuan6/lx/day1/Public/admin/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('brand/add');?>">添加品牌</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品品牌 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="/zhuan6/lx/day1/index.php/Admin/Brand/index" method="get" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
     <input type="text" name="brand_name" value=<?php echo ($_GET['brand_name']); ?>>
    <input type="submit" value=" 搜索 " class="button">
  </form>
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>

     <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td class="first-cell">
      <span style="float:right">
      <a href="/zhuan6/lx/day1<?php echo ($vo["brand_logo"]); ?>" target="_brank">
      <img src="/zhuan6/lx/day1<?php echo ($vo["brand_logo"]); ?>" width="16" height="16" border="0" alt="品牌LOGO">
      </a>
      </span>
			<span onclick="javascript:listTable.edit(this, 'edit_brand_name', 1)" title="点击修改内容" style=""><?php echo ($vo["brand_name"]); ?></span>
			</td>
			<td><a href="http://www.nokia.com.cn/" target="_brank"><?php echo ($vo["site_url"]); ?></a></td>
			<td align="left" ><?php echo ($vo["brand_desc"]); ?></td>
			<td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 1)"><?php echo ($vo["sort_order"]); ?></span></td>
			<td align="center"><img src="images/yes.gif"></td>
			<td align="center">
				<a href="brand.php?act=edit&amp;id=1" title="编辑">编辑</a> |
				<a href="javascript:;" onclick="listTable.remove(1, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<!--start，这些都是显示代码，没有格式化，开发时会删除 -->
    

	<!--end，这些都是显示代码，没有格式化，开发时会删除 -->
    <tr>
		<td align="right" nowrap="true" colspan="6">
      <?php echo ($page); ?>
      </td>
    </tr>
  </tbody></table>

<!-- end brand list -->
</div>
</form>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>