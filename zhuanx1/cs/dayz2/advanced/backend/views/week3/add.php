<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?php 
$data=$model::find()->select("name,id")->where("level=1")->indexBy("id")->column();

?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'type')->dropdownList([''=>"--请选择类型-",'click'=>"单击事件click",'view'=>"链接url"]) ?>
    <?= $form->field($model, 'val') ?>
   <?= $form->field($model, 'level')->dropdownList([''=>"--请选择层级-",'1'=>"一级菜单",'2'=>"二级菜单"]) ?>
   <?= $form->field($model, 'pid')->dropdownList($data,['prompt'=>"--顶级菜单-"]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>