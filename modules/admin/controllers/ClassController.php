<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ClassInfo;

class ClassController extends CommonController
{
    public function actionIndex(){
        $list = ClassInfo::lists('0',true);
        $count = ClassInfo::total('0');
        return $this->render('index',['list' => $list, 'count' => $count]);
    }

    /*Ajax 添加分类*/
    public function actionAdd(){
        $post = Yii::$app->request->post();
        $post['depth'] = $post['depth'] + 1;
        $post['nexus'] = '';
        if($post['depth'] > 1){
            $post['nexus'] = $post['fid'].',';
        }
        $result = ClassInfo::add($post);//入库
        $result['sort'] = 0;$result['count'] = 0;
        return $this->renderPartial('add',['result' => $result]);
    }

    /*Ajax 删除分类*/
    public function actionDelete(){
        ClassInfo::deletes(Yii::$app->request->post('id'));
    }

    /*Ajax 编辑分类信息*/
    public function actionUpclass(){
        $result = ClassInfo::updates(Yii::$app->request->post());
        return $result;
    }

    /*Ajax 展开分类*/
    public function actionUpdown(){
        $list = ClassInfo::lists(Yii::$app->request->post('id'),true);
        $one = ClassInfo::one(Yii::$app->request->post('id'));
        return $this->renderPartial('updown',['list' => $list, 'one' => $one]);
    }

}
