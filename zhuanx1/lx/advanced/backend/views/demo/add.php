<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\models\demo;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

?>

<?php $form = ActiveForm::begin();?>
<!-- 递归展示 -->
<?=$form->field($model,'pid')->dropDownList($data,['prompt'=>'--请选择商品分类--'])->label('商品分类');?>
    <?= $form->field($model, 'name')->label("名称")?>
  
    <?= Html::submitButton('添加',['class'=>'btn btn-success']) ?>


<?php ActiveForm::end(); ?>