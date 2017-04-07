<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\ManagerRecordInfo;

class ManagerRecordController extends CommonController
{
    public function actionList(){
        $page = Yii::$app->request->get('page');
        $search = Yii::$app->request->get('search');
        $record = ManagerRecordInfo::record_list(20,$page,$search);
        return $this->render('list',$record);
    }

    public function actionDelete(){
        ManagerRecordInfo::deletes(Yii::$app->request->get('id'));
        return $this->redirect(Url::to(['manager-record/list']));
    }

}
