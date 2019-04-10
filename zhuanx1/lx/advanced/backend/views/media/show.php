<?php 
use yii\widgets\LinkPager;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<div id="mop">
<table class="table">
<tr>
	<th>id</th>
	<th>media_id</th>
	<th>图片</th>
	<th>操作</th>

</tr>
	<?php foreach ($data as $key => $value) {?>
		<tr>
			<td><?=$value['id']?></td>
			<td><?=$value['media_id']?></td>
			<td><img src="uploads/0.jpg" alt="" width="50px" height="50px"></td>
			<td><button class="del" data="<?=$value['id']?>">删除</button></td>
		</tr>
	<?php }?>
	</table>
	<?php 
    echo LinkPager::widget([
    'pagination' => $pagination,
     ]);
	?>
	</div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
</html>
<script>
	$(function(){
		$(".pagination a").click(function(e){
		  e.preventDefault();	
			var url=$(this).attr('href');
			// alert(url);
			$.ajax({
				url:url,
				type:"get",
				success:function(data){
                   $("#mop").html(data);
				}
			})
		})

		$(".del").click(function(){
			id=$(this).attr("data");
			// alert(id)
			$.ajax({
				url:"/zhuanx1/lx/advanced/backend/web/index.php?r=media/del",
				data:{id:id},
			
				type:"get",
				success:function(res){
                  $("#mop").html(res);
                  // console.log(res);
				}
			})
		})
	})
</script>