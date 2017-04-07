<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\ManagerGroupInfo;
use app\modules\admin\models\FunctionInfo;

class ManagerGroupController extends CommonController
{
    public function actionAdd(){
        $ManagerGroupInfo = new ManagerGroupInfo();
        $ManagerGroupInfoPost = Yii::$app->request->post('ManagerGroupInfo');
        if($ManagerGroupInfo->validate() && $ManagerGroupInfo->load(Yii::$app->request->post())){
            $result = ManagerGroupInfo::add($ManagerGroupInfoPost);
            if($result){
                Yii::mysuccess('管理员分组新增成功！',Url::to(['manager-group/list']));
            }
        }else{
            $func_list = FunctionInfo::group_list(true);
            foreach($func_list as $key => $val){
                $f_list = FunctionInfo::funt_list($val['id'],true);
                $func_list[$key]['f_list'] = $f_list;
            }
            $count = ManagerGroupInfo::count();
            return $this->render('add',['func_list' => $func_list, 'count' => $count]);
        }
    }

    public function actionList(){
        $page = Yii::$app->request->get('page');
        $search = Yii::$app->request->get('search');
        $group = ManagerGroupInfo::lists(20,$page,$search);
        return $this->render('list',$group);
    }

    public function actionUp(){
        $id = Yii::$app->request->get('id');
        if($id == 1){exit;}//超级管理员 不能被编辑
        $ManagerGroupInfo = new ManagerGroupInfo();
        $ManagerGroupInfoPost = Yii::$app->request->post('ManagerGroupInfo');
        if($ManagerGroupInfo->validate() && $ManagerGroupInfo->load(Yii::$app->request->post())){
            $result = ManagerGroupInfo::up($ManagerGroupInfoPost);
            if($result){
                Yii::mysuccess('管理员分组编辑成功！',Url::to(['manager-group/list']));
            }
        }else{
            $func_list = FunctionInfo::group_list(true);
            foreach($func_list as $key => $val){
                $f_list = FunctionInfo::funt_list($val['id'],true);
                $func_list[$key]['f_list'] = $f_list;
            }
            $count = ManagerGroupInfo::count();
            $group_one = ManagerGroupInfo::group_one($id);
            $func_ar = json_decode($group_one['function'],true);
            foreach($func_ar as $key => $val){
                foreach($val as $ke => $va){
                    $new_ar[$va] = $va;
                }
            }//$new_ar 得到这个数组 可以在编辑时还原权限选中
            return $this->render('up',['func_list' => $func_list, 'count' => $count, 'group_one' => $group_one, 'newar' => $new_ar]);
        }
    }

    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        if($id != 1) {//超级管理员 不能被删除
            ManagerGroupInfo::deletes($id);
        }
        return $this->redirect(Url::to(['manager-group/list']));
    }

}
