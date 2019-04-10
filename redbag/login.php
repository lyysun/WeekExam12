<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/8
 * Time: 13:35
 */
$data=$_POST;
if(!empty($data)){
    $data['user_pwd']=md5($data['user_pwd']);
    $pdo=new PDO("mysql:host=127.0.0.1;dbname=7a","root","root");
    $res=$pdo->query("select * from user_red where user_name='{$data['user_name']}'")->fetch(PDO::FETCH_ASSOC);
    if($res){
        if($res['user_pwd']==$data['user_pwd']){
            session_start();
            $_SESSION['user_id']=$res['user_id'];
            echo "<script>alert('登录成功');location.href='redbag.php'</script>";//登录完成后进入红包显示页
        }
        else{
            echo "密码错误";
        }
    }
    else{
        echo "用户不存在";
    }
}
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
<body>
<form action="" method="post">
    <table>
        <tr>
            <td>用户名</td>
            <td>密码</td>
            <td></td>
        </tr>
        <tr>
            <td><input type="text" name="user_name"></td>
            <td><input type="password" name="user_pwd"></td>
            <td><input type="submit" value="登录"></td>
        </tr>

    </table>
</form>
</body>
</html>
