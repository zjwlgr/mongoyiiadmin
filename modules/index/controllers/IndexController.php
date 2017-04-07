<?php

namespace app\modules\index\controllers;

use Yii;

class IndexController extends CommonController
{

    public function actionIndex(){

        return $this->render("index");
    }


}
