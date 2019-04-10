<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Course extends ActiveRecord
{
    public function rules()
	{
	    return [
	        // name, email, subject 和 body 属性必须有值
	        [['name', 'ks', 'js', 'ms'], 'required'],

	        // email 属性必须是一个有效的电子邮箱地址
	        ['addtime', 'safe'],
	    ];
	}
}