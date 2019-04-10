<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{
    // 类Goods和表goods相关联，可以使用AR类的相关方法操作表（增删改查、验证规则）
	public function rules()
	{
	    return [
	        [['name', 'sj','lb','time'], 'safe'],

	    ];
	}

}