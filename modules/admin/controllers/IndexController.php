<?php

namespace app\modules\admin\controllers;

class IndexController extends CommonController
{
    public function actionDefault() {


        return $this->render('default');
    }
}
