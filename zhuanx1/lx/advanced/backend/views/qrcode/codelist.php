<?php
use yii\grid\GridView;
?>

<!-- 使用GridView小部件来显示数据 -->
<?= GridView::widget([
    'dataProvider' => $provider,		// 数据源
    // 显示的列
    'columns' => [
        'id',
        [
        'attribute'=>'path',
        'label'=>'图片',
        'options'=>["<img src=''>"]
        ],
        //'path',
        //'addtime:datetime',
        [
        'attribute'=>'addtime',
        'label'=>'创建时间',
        'format'=>['date', 'php:Y-m-d'],
        ]
        // ...
    ],
]) ?>