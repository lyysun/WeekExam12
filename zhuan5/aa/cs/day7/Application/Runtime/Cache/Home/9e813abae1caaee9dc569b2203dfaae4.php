<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/aa/cs/day8/Public/jquery-1.8.3.js"></script>
</head>
<body>
	<form action="/aa/cs/day8/index.php/Home/Index/insert" method="get">
		<table>
			<tr>
				<td>分类名称</td>
				<td><input type="text" name="nm" id="nm" onblur="nma()">
				<span id="nmin"></span></td>
			</tr>
			<tr>
				
				<td>启用状态</td>
				<td>
				<input type="radio" name="stats" value="是">是
				<input type="radio" name="stats" value="否">否
			</td></tr>
			<tr>
				<td>分类描述</td> 
				<td><textarea name="ms" id="ms" cols="30" rows="10" onblur="msa()"></textarea>
				<span id="msin"></span></td>
			</tr>
			<tr>
				<td><input type="submit"  value="确认添加"></td>
			</tr

		</table>
	</form>
</body>
<script type="text/javascript">
	$("input[type='text'").blur(function(){
       	var nm=document.getElementById('nm').value;
        var nmin=document.getElementById('nmin');
       	if(nm==''){
         nmin.innerHTML='x';
	   }else{
	   	nmin.innerHTML='v';
	   }
	});
	// $("textarea[name='ms']").blur(function(){
 //       	var ms=document.getElementById('ms').value;
 //        var msin=document.getElementById('msin');
 //       	if(ms==''){
 //         msin.innerHTML='x';
	//    }
	// });
// function nma(){
// 	var nm=document.getElementById('nm').value;
// 	var nmin=document.getElementById('nmin');
// 	if(nm==''){
//          nmin.innerHTML='x';
// 	}
// }
function msa(){
	var ms=document.getElementById('ms').value;
	var msin=document.getElementById('msin');
	if(ms==''){
        msin.innerHTML='x';
	}else{
		msin.innerHTML='v';
	}
}
</script>
</html>