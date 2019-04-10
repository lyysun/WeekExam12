<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/8
 * Time: 14:20
 */

session_start();
$f_user_id=$_SESSION['user_id'];
if(empty($f_user_id)){
    echo "<script>alert('禁止非法进入请先登录');location.href='login.php'</script>";
}

$pdo=new PDO("mysql:host=127.0.0.1;dbname=7a","root","root");
$user=$pdo->query("select * from user_red where user_id=$f_user_id")->fetch(PDO::FETCH_ASSOC);
$redbagxx=$pdo->query("select * from redbag")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    a{
        color:black;
    }
</style>
<body>
    <h3>用户：<?php echo $user['user_name']?></h3>
    <h4 style="color: red">余额<?php echo $user['balance']?></h4>

    <table border="1" cellpadding="0" cellspacing="0" width="30%">
        <tr style="text-align: center">
            <th>id</th>
            <th>红包金额</th>
            <th>红包份数</th>
            <th>剩余份数</th>
            <th>抢红包</th>
        </tr>
        <?php foreach ($redbagxx as $key=>$val){?>
            <tr style="text-align: center" class="tt">
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['money']?></td>
                <td><?php echo $val['num']?></td>
                <td><?php echo $val['s_num']?></td>
                <td><input type="button" value="抢红包" class="btn" where="<?php echo $val['id']?>"></td>
            </tr>
        <?php }?>
    </table>
    <a href="sendbag.php">发红包</a><br><br>
    <a href="login.php">切换用户</a>
</body>
<script src="jquery-2.1.4.min.js"></script>
<script>
    $(function () {
        var e=$(".tt");
        for(var i=1;i<=e.length;i++){
            var ee=$("table").children("tr").eq(i).children("td");
            // console.log(ee)
        }
        // e.children.3.html()==0;

        //
        // if(e==0){
        //     $("input:button").attr("disabled",true);
        // }
    })
    $(document).on("click",".btn",function () {
        var red_id=$(this).attr("where");
        $.ajax({
            url:"getbag.php",
            type:'post',
            data:{red_id:red_id},
            dataType:'json',
            success:function (e) {
                if(e.code==200){
                    alert('抢到'+e.data.get_money);
                    history.go(0);
                    return ;
                }
                alert(e.msg);
            }
        })
    })
</script>
</html>
