<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 添加管理员 </title>
<base href="/zhuan6/lx/day1/Public/admin/" />
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Admin/index');?>">管理员列表</a></span>
<span class="action-span1"><a href="<?php echo U('Index/index');?>">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加管理员 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="" method="post" name="theForm" enctype="multipart/form-data" >
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">管理员名称:</td>
				<td><input type="text" name="admin_name" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">管理员密码:</td>
				<td><input type="password" name="password" maxlength="20" value="" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">添加角色:</td>
				<td>
				<?php if(is_array($role_name)): foreach($role_name as $key=>$v): ?><input type="checkbox" name="role_id[]" value="<?php echo ($v["role_id"]); ?>"> <?php echo ($v["role_name"]); endforeach; endif; ?>
					
					
				</td>
			</tr>		
      </tbody></table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
  </form>
</div>


</div>

</body>
</html>