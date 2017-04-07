<?php

namespace app\modules\admin\controllers;

use yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\admin\models\ManagerInfo;
use app\modules\admin\models\ManagerRecordInfo;

class LoginController extends Controller
{
    public $layout = "@app/views/layouts/base.php";

    public function actionIndex() {
        $model = new ManagerInfo();
        if($model->validate() && $model->load(Yii::$app->request->post())){
            $ManagerPost = Yii::$app->request->post('ManagerInfo');
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//json格式输出
            if($this->createAction('captcha')->validate($ManagerPost['validates'], false)){//验证码OK
                $result = $model->login($ManagerPost['username']);
                if($result['password'] != md5($ManagerPost['password'])){
                    return ['code' => 0, 'msg' => '用户名或密码错误！'];
                }else{
                    if($result['locking'] == 1){
                        return ['code' => 0, 'msg' => '该管理员已被系统锁定！'];
                    }else{
                        unset($result['password']);//sesssion 不记录密码
                        $result['id'] = Yii::getMongoId($result['_id']);
                        \Yii::$app->session->set('manager',$result);//注册session
                        $model->number($result['id'],$result['number']);//更新次数、ip、登录时间
                        ManagerRecordInfo::add($result);//登录记录
                        return ['code' => 1, 'msg' => Url::to(['index/default'])];
                    }
                }
            }else{
                return ['code' => 0, 'msg' => '验证码输入错误！'];
            }
        }else{
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'backColor' => 0xf9f9f9,
                'width' => 156,
                'height' => 34,
                'offset' => 10,
                'maxLength' => 5,
                'minLength' => 5,
                'isnumber' => 1,//0字母，1为数字，2为字母加数字
                'foreColor' => 0x343434,
                'padding' => 5
            ],
        ];
    }

    public function actionLoginout(){
        \Yii::$app->session->remove('manager');
        return $this->redirect(['login/index'], 301);
    }




}
