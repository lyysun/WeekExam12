<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Day14 */

$this->title = 'Create Day14';
$this->params['breadcrumbs'][] = ['label' => 'Day14s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day14-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
