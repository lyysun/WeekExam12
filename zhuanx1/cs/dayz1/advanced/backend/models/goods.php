<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{
   public function rules(){
   	   return [
         [['name','sj','lb','time'],'safe'],
   	   ];

   } 
}