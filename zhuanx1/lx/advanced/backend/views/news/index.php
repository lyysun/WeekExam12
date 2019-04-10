<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '展示';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加新闻', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
           [ 
              'attribute'=>'path',
              'format'=>'raw',
              "value"=>function($model){
                 return Html::img($model->path, ['width' => '100px']);
              }
           ],
            'summary',
            'author',
            //'addtime:datetime',
            //'content:ntext',
            //'visit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
