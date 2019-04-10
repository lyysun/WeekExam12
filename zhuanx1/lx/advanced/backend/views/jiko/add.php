<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<h2>注册</h2>

			<table align="center">
				<tr>
					<td>用户名: <input type="text" id="name"></td>
				</tr>
				<tr>
					<td>密码: <input type="text" id="pwd"></td>
				</tr>
				<tr><td><button id="zc">注册</button></td></tr>
			</table>
	
	</center>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$("#zc").click(function() {
       name=$("#name").val();
        pwd=$("#pwd").val();
       // alert(name);
       $.ajax({
       	url:"";
       	data:{name:name,pwd:pwd},
       	dataType:"json",
       	success:function(){

       	}
       })
});

</script>
</html>