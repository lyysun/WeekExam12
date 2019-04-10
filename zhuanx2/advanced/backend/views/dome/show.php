
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
新增<span class="level">一</span>级地区 ：<input type="text" name="name" id="name"> <button id="add">新增</button> <button id="del">返回上一级</button>
   <h4><span class="level">一</span>级地区</h4>
   <table id="box">
   	<?php foreach ($data as $key => $value) {?>
		<tr>
			<td><?=$value['region_name']?></td>
			<td id="<?=$value['region_id']?>" ><a href="javascrpit:;" class="gl" > 管理</a><a href="javascrpit:;" class="delete"> | 删除</a></td>
		</tr>
	<?php }?>
   </table>
	
</body>
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript">


$("#box").on("click",'.delete',function(){
		  
       id=$(this).parent().attr('id');
         //存id的层级
        alert(id)
       $.ajax({
      
	 	url:"index.php?r=dome/del",
	 	data:{id,id},
	  
	 	  success:function(msg){
	 	  	alert(msg);
               $("tr").next().next().remove();
                   }
	 })
         
	})


	


  var arr=['一','二','三','四'];
  var item=0;
  //存id
  var ids=[0];
   
   $("#del").click(function(){
           item--;
            //从存id的层级查找出上级的id
           id=ids[item];
           fz();
   })

	$("#box").on("click",'.gl',function(){
		   item++;
       id=$(this).parent().attr('id');
         //存id的层级
         
        ids[item]=id;
       // console.log(ids);
       fz();
         
	})
    
  
	$("#add").click(function(){
		// alert(1);
	     region_type=item;
	     // alert(region_type);
		  region_name=$("#name").val();
		if (region_type==0) {
           parent_id=0;
		}else{
           parent_id=ids[item];
		}
		// alert(parent_id);
       $.ajax({
	         	url:"index.php?r=dome/add",
	         	dataType:"json",
	         	data:{parent_id:parent_id,region_name:region_name,region_type:region_type},
	         	success:function(res){

	         	}
         	})

		
	})



	function fz(){

       var  level=arr[item];

       $(".level").html(level);

		  $.ajax({
         	url:"index.php?r=dome/show&id="+id,
         	dataType:"json",
         	success:function(res){
         		var str="<tr>";
         		$.each(res,function(k,v){
         		    // console.log(v);
         		    str+='<td>'+v.region_name+'</td>';
         		    str+='<td id='+v.region_id+'><a href="javascrpit:;" class="gl" > 管理</a><a href="javascrpit:;" class="delete"> | 删除</a></td></tr>';
         		});

              $("#box").html(str);
         	}
            
         })
	}
</script>
</html>