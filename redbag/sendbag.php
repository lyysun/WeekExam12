<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/8
 * Time: 13:42
 */
session_start();
$f_user_id=$_SESSION['user_id'];
if(empty($f_user_id)){
    echo "<script>alert('禁止非法进入请先登录');location.href='login.php'</script>";
}
$redbag=$_POST;
if(!empty($redbag)){
    $pdo=new PDO("mysql:host=127.0.0.1;dbname=7a","root","root");
    if($redbag['money']<$redbag['num']*0.01){
        echo "<script>alert('每个红包不能低于0.01');history.go(-1)</script>";
        exit();
    }
    try{
        $pdo->beginTransaction();//事务
        $sql="update user_red set balance=balance-{$redbag['money']} where user_id=$f_user_id";//修改发红包用户的金额
        $sql2="insert into redbag values(null,{$redbag['money']},{$redbag['num']},{$redbag['num']})";//添加红包
        if(!$pdo->exec($sql) || !$pdo->exec($sql2)){
            throw new Exception($pdo->errorInfo()[2]);
        }
        $pdo->commit();
    }catch (Exception $e){
        $pdo->rollBack();

    }
    $arr=sendbag($redbag['money'],$redbag['num']);
    $hong=$pdo->query("select *  from redbag order by id desc")->fetch(PDO::FETCH_ASSOC);
    foreach ($arr as $key=>$val){
        $sql3="insert into red_bag_info(red_id,one_money) value({$hong['id']},$val)";
        $r=$pdo->exec($sql3);
    }
    if($r){
        echo "<script>alert('发送成功');location.href='redbag.php'</script>";
    }
}
function sendbag($p,$n){
    $max=($p/$n)*2;//单个红包最大值
    $arr=[];//存放红包
    for ($n;$n>0;$n--){
        if($n==1){
            $arr[]=$p;
            continue;
        }
        $max_=$p-(($n-1)*0.01);
        if($max_>$max){
            $max_=$max;
        }
        $min_=$p-(($n-1)*$max);
        if($min_<0){
            $min_=0;
        }
        $bag=(rand($min_*100,$max_*100))/100;
        $arr[]=$bag;
        $p-=$bag;
    }
    return $arr;
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
            <td>总金额：<input type="text" name="money">元</td>
        </tr>
        <tr>
            <td>数&nbsp;&nbsp;&nbsp;量：<input type="text" name="num">个</td>
        </tr>
        <tr>
            <td><input type="submit" value="塞进红包"></td>
        </tr>
    </table>
</form>
</body>
</html>
