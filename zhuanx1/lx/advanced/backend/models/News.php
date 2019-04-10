<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $summary
 * @property string $author
 * @property int $addtime
 * @property string $content
 * @property int $visit
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addtime', 'visit'], 'integer'],
            [['content'], 'string'],
            [['title'], 'unique',],
           
            [['author'], 'string', 'max' => 30],
            [['path'], 'file'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'path' => '图片',
            'summary' => 'Summary',
            'author' => '作者',
           
            'content' => '内容',
           
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path='uploads/' . $this->path->baseName . '.' . $this->path->extension;
            $this->path->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }
}
