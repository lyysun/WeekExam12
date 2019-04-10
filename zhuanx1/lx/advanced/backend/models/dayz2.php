<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dayz2".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $pid
 * @property string $val
 * @property string $level
 * @property int $addtime
 */
class Dayz2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dayz2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'addtime'], 'integer'],
            [['name', 'type', 'level'], 'string', 'max' => 22],
            [['val'], 'string', 'max' => 100],
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
            'pid' => '父级菜单名称',
            'val' => '类型对应的值',
            'level' => '菜单层级',
           
        ];
    }
}