<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "day14".
 *
 * @property int $id
 * @property string $name
 * @property int $pid
 */
class Day14 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'day14';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['name'], 'string', 'max' => 44],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pid' => 'Pid',
        ];
    }
}
