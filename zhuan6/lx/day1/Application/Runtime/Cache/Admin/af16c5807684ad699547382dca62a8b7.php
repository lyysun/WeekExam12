<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 节点管理 </title>
<base href="/zhuan6/lx/day1/Public/admin/" />
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Node/index');?>">节点列表</a></span>
<span class="action-span1"><a href="<?php echo U('Index/index');?>">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加节点 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="/zhuan6/lx/day1/index.php/Admin/Node/add" method="post" name="theForm" enctype="multipart/form-data" >
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">节点名称:</td>
				<td><input type="text" name="title" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">选择父级节点:</td>
				<td>
					<select name="parent_id">
					<option value="0">根节点..</option>
					<?php if(is_array($nodelist)): foreach($nodelist as $key=>$v): ?><option value="<?php echo ($v["node_id"]); ?>"><?php echo str_repeat("&nbsp;",$v['level']); echo ($v["title"]); ?></option><?php endforeach; endif; ?>
					
	                </select>
	            </td>
			</tr>
			<tr>
				<td class="label">控制器:</td>
				<td><input type="text" name="controller" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">方法:</td>
				<td><input type="text" name="action" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<!-- <tr>
				<td class="label">是否启用:</td>
				<td>
					<input type="radio" name="is_start" value="1" checked="true"> 是
					<input type="radio" name="is_start" value="0"> 否  
				</td>
			</tr>	 -->	
		 
      </tbody></table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
    <input type="hidden"  value="insert">
    <input type="hidden"  value="">
  </form>
</div>


</div>

</body>
</html>