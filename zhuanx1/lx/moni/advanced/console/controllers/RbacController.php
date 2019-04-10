<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // 添加 "createPost" 权限
        $del = $auth->createPermission('del');
        $del->description = '删除';
        $auth->add($del);

        // 添加 "updatePost" 权限
        $update = $auth->createPermission('update');
        $update->description = '修改';
        $auth->add($update);

        // 添加 "author" 角色并赋予 "createPost" 权限
        $yonghu = $auth->createRole('yonghu');
        $auth->add($yonghu);
        $auth->addChild($yonghu, $update);

        // 添加 "admin" 角色并赋予 "updatePost" 
		// 和 "author" 权限
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $del);
        $auth->addChild($admin,  $yonghu);

        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($yonghu, 2);
        $auth->assign($admin, 1);
    }
}