<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\day14;
/* @var $this yii\web\View */
/* @var $model backend\models\Day14 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="day14-form">
     
    <?php $form = ActiveForm::begin(); ?>
   

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
