<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <?= $form->field($model, 'name')->label("课程名称") ?>
    <?= $form->field($model, 'ks')->label("课时") ?>
     <?= $form->field($model, 'js')->label("代课讲师") ?>
      <?= $form->field($model, 'ms')->label("描述") ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>