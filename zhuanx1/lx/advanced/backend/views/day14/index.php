<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Day14Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Day14s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="day14-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Day14', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'pid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
