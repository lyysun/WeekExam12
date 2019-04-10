<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Media extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
        	$path='uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $res=$this->imageFile->saveAs($path);
           if($res){
           	return $path;
           }
        } else {
            return false;
        }
    }
}