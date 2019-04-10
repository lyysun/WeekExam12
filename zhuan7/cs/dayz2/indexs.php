<?php 
session_start();
$tel=$_SESSION['tel'];
// var_dump($tel);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
	<h3>当前用户是：<?php echo $tel;?></h3>
		<form action="indexs1.php" method="post">
			<table>
				<tr>
					<td>手机号：
                            <select name="tel" id="">
                            	<option value="158666666">158666666</option>
                            	<option value="154666666">154666666</option>
                            </select>
					</td>
				</tr>
				<tr>
					<td>姓名：<input type="text" name="name"></td>
				</tr>
				<tr>
					<td>转账金额：<input type="text" name="m"></td>
				</tr>
				<tr>
					<td><input type="submit" value="确认转账" id="yz"></td>
				</tr>
			</table>
		</form>
	</center>
</body>
<script type="text/javascript" src="j.js"></script>
<script type="text/javascript">
 $(function(){

     $("#yz").live("click",function(){
     	// alert(1);
     	tel=$("[name='tel']").val();
     	name=$("[name='name']").val();
        // alert(name)
        $.ajax({
        	url:"yz.php",
        	type:"get",
        	data:{tel:tel,name:name},
        	success:function(res){
                   if(res=="手机号与姓名符合"){
                   	 alert("手机号与姓名符合");
                   }else{
                   	alert("手机号与姓名不符合");
                   	
                   }
        	}

        })


     })

 })	 

</script>
</html>
