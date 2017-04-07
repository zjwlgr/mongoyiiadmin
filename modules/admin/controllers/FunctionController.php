<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\FunctionInfo;

class FunctionController extends CommonController
{
    public function actionAdd() {
        $function = new FunctionInfo();
        $FunctionInfo = Yii::$app->request->post('FunctionInfo');
        if($function->validate() && $function->load(Yii::$app->request->post())){
            $result = FunctionInfo::add($FunctionInfo);
            if($result){
                Yii::mysuccess('系统功能新增成功！',Url::to(['function/list']));
            }
        }else{
            $group_list = FunctionInfo::group_list();
            return $this->render('add',['group_list' => $group_list]);
        }
    }

    public function actionList(){
        $group_list = FunctionInfo::group_list();
        foreach($group_list as $key => $val){
            $funt_list = FunctionInfo::funt_list($val['id']);
            $group_list[$key]['funt_list'] = $funt_list;
        }
        return $this->render('list',['group_list' => $group_list]);
    }

    public function actionUp(){
        $function = new FunctionInfo();
        if($function->validate() && $function->load(Yii::$app->request->post())){
            $result = FunctionInfo::up(Yii::$app->request->post('FunctionInfo'));
            if($result){
                Yii::mysuccess('系统功能编辑成功！',Url::to(['function/list']));
            }
        }else{
            $group_list = FunctionInfo::group_list();
            $funt_one = FunctionInfo::funt_one(Yii::$app->request->get('id'));
            return $this->render('up',['group_list' => $group_list, 'funt_one' => $funt_one]);
        }
    }

    public function actionDelete(){
        FunctionInfo::deletes(Yii::$app->request->get('id'));
        return $this->redirect(Url::to(['function/list']));
    }


}
