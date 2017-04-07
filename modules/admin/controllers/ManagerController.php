<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\ManagerInfo;
use app\modules\admin\models\ManagerGroupInfo;

class ManagerController extends CommonController
{
    public function actionList(){
        $page = Yii::$app->request->get('page');
        $search = Yii::$app->request->get('search');
        $group_id = Yii::$app->request->get('groupid');
        $manager = ManagerInfo::manager_list(20,$page,$search,$group_id);
        foreach($manager['list'] as $key => $val){
            $group = ManagerGroupInfo::group_one($val['group_id']);
            $manager['list'][$key]['groupname'] = $group['gname'];
        }
        $manager['select_list'] = ManagerGroupInfo::select_list();
        return $this->render('list',$manager);
    }

    public function actionAdd(){
        $model = new ManagerInfo();
        $ManagerInfoPost = Yii::$app->request->post('ManagerInfo');
        if($model->validate() && $model->load(Yii::$app->request->post())){
            $result = $model->add($ManagerInfoPost);
            if($result){
                Yii::mysuccess('管理员新增成功！',Url::to(['manager/list']));
            }else{
                Yii::myerror('用户 '.$ManagerInfoPost['username'].' 已存在，请更换！');
            }
        }else {
            $count = ManagerInfo::count();
            $select_list = ManagerGroupInfo::select_list();
            return $this->render('add', ['count' => $count, 'select_list' => $select_list]);
        }
    }

    public function actionUp(){
        $model = new ManagerInfo();
        $ManagerInfoPost = Yii::$app->request->post('ManagerInfo');
        if($model->validate() && $model->load(Yii::$app->request->post())){
            $result = $model->up($ManagerInfoPost);
            if($result){
                Yii::mysuccess('管理员编辑成功！',Url::to(['manager/list']));
            }else{
                Yii::myerror('用户 '.$ManagerInfoPost['username'].' 已存在，请更换！');
            }
        }else {
            $count = ManagerInfo::count();
            $select_list = ManagerGroupInfo::select_list();
            $manager_one = ManagerInfo::manager_one(Yii::$app->request->get('id'));
            return $this->render('up', ['count' => $count, 'select_list' => $select_list, 'one' => $manager_one]);
        }
    }

    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        if($id != 1) {//默认管理员 不能被删除
            ManagerInfo::deletes($id);
        }
        return $this->redirect(['manager/list']);
    }

    /*修改密码*/
    public function actionEditpwd(){
        $model = new ManagerInfo();
        $ManagerInfoPost = Yii::$app->request->post('ManagerInfo');
        if($model->validate() && $model->load(Yii::$app->request->post())){
            $result = $model->editpwd($ManagerInfoPost);
            if($result){
                Yii::mysuccess("密码修改成功，5秒后将重新登录！",Url::to(['login/loginout']),5);
            }else{
                Yii::myerror("旧密码输入错误！",'',3);
            }
        }else{
            $manager_session = $this->manager_session;
            return $this->render('editpwd',['id' => $manager_session['_id']]);
        }

    }

}
