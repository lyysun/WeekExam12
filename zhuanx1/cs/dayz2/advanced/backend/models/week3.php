<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "week3".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $val
 * @property int $level
 * @property int $pid
 */
class Week3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'week3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'pid'], 'integer'],
            [['name', 'type', 'val'], 'string', 'max' => 22],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名称',
            'type' => '菜单类型',
            'val' => '类型对应的值',
            'level' => '层级',
            'pid' => '父级菜单',
        ];
    }
}