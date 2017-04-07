<?php

namespace app\modules\api\models;

use yii\mongodb\Query;
use yii\mongodb\ActiveRecord;

class Article extends ActiveRecord{

    //指定集合名称
    public static function collectionName()
    {
        return 'runoob';
    }

    //定义字段属性
    public function attributes()
    {
        return [
            '_id',
            'title',
            'description'
        ];
    }

    public static function lists(){
        $Article = false;
        return $Article;
    }


}