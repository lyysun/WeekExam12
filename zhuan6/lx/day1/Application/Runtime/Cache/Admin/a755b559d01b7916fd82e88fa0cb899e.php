<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 添加权限 </title>
<base href="/zhuan6/lx/day1/Public/admin/" />
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Role/index');?>">角色列表</a></span>
<span class="action-span1"><a href="<?php echo U('Index/index');?>">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 分配权限【<?php echo ($role_name); ?>】 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="/zhuan6/lx/day1/index.php/Admin/Role/setPrivillage" method="post" name="theForm" enctype="multipart/form-data" >
	 <table width="100%" id="general-table">
		<tbody>
		 
		 <?php if(is_array($nodelist)): foreach($nodelist as $key=>$vo): ?><tr>
				<td width="18%" valign="top" class="first-cell">
				     <input type="checkbox"  class="checkbox" name="node_id[]" value="<?php echo ($vo["node_id"]); ?>" <?php if($vo["curr"] == 1): ?>checked<?php endif; ?> > <?php echo ($vo["title"]); ?> |
				</td>
				    
				<td>
				  <?php if(is_array($vo["son"])): foreach($vo["son"] as $key=>$v): ?><div style="width:200px;float:left" >
					      <input type="checkbox"  class="checkbox" name="node_id[]" value="<?php echo ($v["node_id"]); ?>" <?php if($v["curr"] == 1): ?>checked<?php endif; ?>   ><?php echo ($v["title"]); ?>
					</div><?php endforeach; endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>

			
			
			
			
      </tbody>
    </table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
    <input type="hidden"  value="<?php echo ($role_id); ?>" name="role_id">
  </form>
</div>


</div>

</body>
</html>