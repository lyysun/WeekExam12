<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "moni3a".
 *
 * @property int $id
 * @property int $pid
 * @property string $name
 * @property string $type
 * @property string $val
 * @property string $level
 * @property string $sort
 */
class Moni3a extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'moni3a';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['name', 'type', 'val'], 'string', 'max' => 44],
            [['level'], 'string', 'max' => 22],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '选择类型',
            'name' => '名称',
            'type' => '展示的类型',
            'val' => '输入方式',
            'level' => '选择级别',
            
        ];
    }
}