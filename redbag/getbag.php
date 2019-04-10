<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/8
 * Time: 14:33
 */
session_start();
$d_user_id=$_SESSION['user_id'];
if(empty($d_user_id)){
    echo "<script>alert('禁止非法进入请先登录');location.href='login.php'</script>";
}
$red_id=$_POST['red_id'];
$pdo=new PDO("mysql:host=127.0.0.1;dbname=7a","root","root");
$sql="select * from redbag where id=$red_id";
$redbag=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if($redbag['s_num']==0){
    echo json_encode(['code'=>5001,'msg'=>'红包已被抢完']);
    exit();
}
$sql2="select * from red_bag_info where red_id=$red_id and  l_user_id=$d_user_id";
$s_redbag=$pdo->query($sql2)->fetch(PDO::FETCH_ASSOC);
if($s_redbag){
    echo json_encode(['code'=>5002,'msg'=>'不得贪心，已领过了']);
    exit();
}
$sql2_1="select * from red_bag_info where red_id=$red_id and statue='未领取'";
$xx=$pdo->query($sql2_1)->fetch(PDO::FETCH_ASSOC);
//红包信息表 ----状态、领取用户id、领取时间
//红包表  -----剩余数量
//用户表  -----用户余额
$time=date("Y-m-d H:i:s",time());
$sql3="update red_bag_info set l_user_id=$d_user_id,statue='已领取',l_time='$time' where red_id=$red_id and one_money={$xx['one_money']}";
$sql4="update redbag set s_num=s_num-1 where id=$red_id";
$sql5="update user_red set balance=balance+{$xx['one_money']} where user_id=$d_user_id";
$x=$pdo->query("select * from redbag where id=$red_id")->fetch(PDO::FETCH_ASSOC);
$data=[
    's_num'=>$x['s_num'],
    'get_money'=>$xx['one_money']
];
if($pdo->exec($sql3) && $pdo->exec($sql4) && $pdo->exec($sql5)){
    echo json_encode(['code'=>200,'data'=>$data]);
    exit();
}

?>