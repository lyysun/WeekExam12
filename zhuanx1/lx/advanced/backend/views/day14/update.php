<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Day14 */

$this->title = 'Update Day14: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Day14s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="day14-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
