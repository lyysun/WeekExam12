<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\course;
use yii\data\ActiveDataProvider;
/**
 * Site controller
 */
class CourseController extends Controller
{

   public $enableCsrfValidation=false;

    public function actionAdd()
    {
       $model=new Course;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['show']);
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }
    //展示

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
	return $this->render("show",['provider'=>$provider]);

    }

  

}