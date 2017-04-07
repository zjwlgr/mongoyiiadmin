<?php

namespace app\controllers;

use Yii;
use yii\mongodb\Query;
use yii\web\Controller;
use app\modules\admin\models\ClassInfo;

class TestController extends Controller
{
    public function actionIndex()
    {
        /*$mysql_list = ClassInfo::listss();
        foreach ($mysql_list as $key => $val){

            echo $val['username'].'<br />';
            $collection = \Yii::$app->mongodb->getCollection('class');
            $res = $collection->insert([
                'fid' => $val['fid'],
                'nexus' => $val['nexus'],
                'depth' => $val['depth'],
                'name' => $val['name'],
                'sort' => $val['sort'],
                'ctime' => $val['ctime']
            ]);

            var_dump($res);
        }*/
    }


}
