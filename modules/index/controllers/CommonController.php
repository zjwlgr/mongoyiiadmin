<?php

namespace app\modules\index\controllers;

use Yii;
use yii\web\Controller;

class CommonController extends Controller {
    
    public function init() {
        $view = \Yii::$app->getView();//获取当前视图对像
        $view->params['nav_list'] = $this->nav_list();
    }

    /*导航列表*/
    public function nav_list(){
        return false;
    }




}
