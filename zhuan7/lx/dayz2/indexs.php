<?php 
session_start();
$tel1=$_SESSION['tel'];
var_dump($tel1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<form action="indexs1.php" method="post">
	<h4>登陆的账户是：<?php echo $tel1;?></h4>
		<table>
			<tr>
				<td>转账金额：<input type="text" name="m">(元)</td>
			</tr>
			<tr>
				<td>选择转账的账户号：<select name="tel" id="">
					<option value="158666666">158666666</option>
					<option value="154666666">154666666</option>
				</select></td>
			</tr>
			<tr>
				<td><input type="submit" value="确认转账"></td>
			</tr>
		</table>
	</form>
</body>
<script type="text/javascript" src="j.js"></script>
<script type="text/javascript">
	
	$(function(){
		$("[name='m']").live("blur",function(){
			// alert(1)
			m=$(this).val();
			$.ajax({
                url:"yz.php",
                type:"get",
                data:{m:m},
                success:function(res){
                	if(res){
                		  alert(res);
                	}
                 
                }

			})
		})
	})
</script>
</html>