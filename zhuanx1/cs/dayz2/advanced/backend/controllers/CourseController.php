<?php
namespace backend\controllers;

use Yii;
use backend\models\course;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class CourseController extends Controller
{
    
 // 添加
    public function actionAdd()
    {
        $model = new Course;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['show']);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }
// 展示
    function actionShow(){


		$query = Course::find();

		$provider = new ActiveDataProvider([
		    'query' => $query,
		    'pagination' => [
		        'pageSize' => 2,
		    ],
		    'sort' => [
		        'defaultOrder' => [
		            'id' => SORT_DESC,
		            'name' => SORT_ASC,
		        ]
		    ],
		]);
		 return $this->render('show', [
                'provider' => $provider,
            ]);
    }
}